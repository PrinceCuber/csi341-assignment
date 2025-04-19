<?php
include_once 'Config/util.php';


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is already logged in
if (isset($_SESSION['student_id'])) {
    // Redirect to the dashboard or home page
    header("Location: student/dashboard.php");
    exit();
} elseif (isset($_SESSION['coordinator_id'])) {
    // Redirect to the dashboard or home page
    header("Location: coordinator/dashboard.php");
    exit();
} elseif (isset($_SESSION['organisation_id'])) {
    // Redirect to the dashboard or home page
    header("Location: organisation/dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Validate the input
    if (empty($email) || empty($password)) {
        echo "Email and password are required.";
        exit();
    }

    // Connect to the database
    $conn = getDatabase();
}


?>