<?php
header('Content-Type: application/json');
require_once 'conf.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle match confirmation
if (isset($_GET['action']) && $_GET['action'] === 'confirm') {
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare("INSERT INTO confirmed_matches (student_id, org_id) VALUES (?, ?)");
    $stmt->execute([$input['studentId'], $input['orgId']]);
    exit(json_encode(['status' => 'success']));
}

// Main matching logic
$input = json_decode(file_get_contents('php://input'), true);
$locationFilter = $input['location'] ?? '';

// Fetch all students (filter by location if specified)
$studentsQuery = "SELECT * FROM studentsTable2" . 
                 ($locationFilter ? " WHERE preferred_Location = :location" : "");
$studentsStmt = $pdo->prepare($studentsQuery);
if ($locationFilter) $studentsStmt->bindParam(':location', $locationFilter);
$studentsStmt->execute();
$students = $studentsStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all organizations
$orgs = $pdo->query("SELECT * FROM organisation_registration")->fetchAll(PDO::FETCH_ASSOC);

// Matching function
function calculateMatchScore($student, $org) {
    // Skill overlap (50% weight)
    $studentSkills = array_map('trim', explode(',', $student['experience']));
    $orgSkills = array_map('trim', explode(',', $org['ExperienceNeeded']));
    $commonSkills = array_intersect($studentSkills, $orgSkills);
    $skillScore = count($commonSkills) / max(1, count($orgSkills));

    // Location match (30% weight) - removed if you don't have org location
    $locationScore = 1; // Or implement if you add location to org table

    // Availability (20% weight)
    $availabilityScore = 1; // Remove or implement if you have dates

    return ($skillScore * 0.5) + ($locationScore * 0.3) + ($availabilityScore * 0.2);
}

// Generate matches
$matches = [];
foreach ($orgs as $org) {
    foreach ($students as $student) {
        $score = calculateMatchScore($student, $org);
        if ($score >= 0.5) {  // Threshold
            $matches[] = [
                'student_id' => $student['omang_Or_passportNo'],
                'student_skills' => $student['experience'],
                'org_id' => $org['organisation_id'],
                'org_name' => $org['Organisation_name'],
                'org_skills' => $org['ExperienceNeeded'],
                'score' => $score
            ];
        }
    }
}

// Sort by score (highest first)
usort($matches, fn($a, $b) => $b['score'] <=> $a['score']);

echo json_encode(['matches' => $matches]);
?>