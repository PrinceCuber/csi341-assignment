<?php
// Database connection settings
$servername = "10.0.19.74";  // Change if you're using a different host
$username = "phi01419";         // Change if necessary
$password = "phi01419";             // Change if necessary
$dbname = "db_phi01419"; // The database name we created

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and get form data
    $studentName = mysqli_real_escape_string($conn, $_POST['student-name']);
    $organization = mysqli_real_escape_string($conn, $_POST['organization']);
    $skillsAssessment = (int) $_POST['skills-assessment'];
    $workEthic = (int) $_POST['work-ethic'];
    $communication = (int) $_POST['communication'];
    $problemSolving = (int) $_POST['problem-solving'];
    $professionalism = (int) $_POST['professionalism'];
    $overallFeedback = mysqli_real_escape_string($conn, $_POST['overall-feedback']);

    // SQL query to insert the data into the database
    $sql = "INSERT INTO assessments (student_name, organization, skills_assessment, work_ethic, communication, problem_solving, professionalism, overall_feedback)
            VALUES ('$studentName', '$organization', $skillsAssessment, $workEthic, $communication, $problemSolving, $professionalism, '$overallFeedback')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Assessment submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
