<?php
// Database connection
$host = 'localhost';
$db = 'assessment_db';
$user = 'root'; // change if using a different username
$pass = '';     // update password if needed

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$student_name = $_POST['student-name'];
$organization = $_POST['organization'];
$skills_assessment = $_POST['skills-assessment'];
$work_ethic = $_POST['work-ethic'];
$communication = $_POST['communication'];
$problem_solving = $_POST['problem-solving'];
$professionalism = $_POST['professionalism'];
$overall_feedback = $_POST['overall-feedback'];

// Prepare statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO assessments (
    student_name, organization, skills_assessment, work_ethic, communication, problem_solving, professionalism, overall_feedback
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssiiiiis",
    $student_name,
    $organization,
    $skills_assessment,
    $work_ethic,
    $communication,
    $problem_solving,
    $professionalism,
    $overall_feedback
);

if ($stmt->execute()) {
    echo "Assessment submitted successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
