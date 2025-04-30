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
    $attachmentDuration = mysqli_real_escape_string($conn, $_POST['attachment-duration']);
    $knowledgeAssessment = (int) $_POST['knowledge-assessment'];
    $timeManagement = (int) $_POST['time-management'];
    $teamwork = (int) $_POST['teamwork'];
    $initiative = (int) $_POST['initiative'];
    $overallPerformance = (int) $_POST['overall-performance'];
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    // SQL query to insert the data into the database
    $sql = "INSERT INTO coordinator_assessments (student_name, attachment_duration, knowledge_assessment, time_management, teamwork, initiative, overall_performance, comments)
            VALUES ('$studentName', '$attachmentDuration', $knowledgeAssessment, $timeManagement, $teamwork, $initiative, $overallPerformance, '$comments')";

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
