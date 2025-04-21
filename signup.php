<?php
include_once 'Config/util.php';
include_once 'Config/helper.php';

// Include the database connection file
$conn = getDatabase();

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
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $user_type = $_POST['role'];

    // Validate the input
    if (empty($name) || empty($email) || empty($password) || empty($user_type)) {
        header("Location: signup.php?error=All fields are required.");
        exit();
    }

    if(emailExist($email)) {
        header("Location: signup.php?error=Email already exists.");
        exit();
    }
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Invalid email format.");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database based on user type
    if ($user_type == 'student') {
        $stmt = $conn->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
    } elseif ($user_type == 'coordinator') {
        $stmt = $conn->prepare("INSERT INTO coordinators (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
    } elseif ($user_type == 'organisation') {
        $stmt = $conn->prepare("INSERT INTO organisations (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
    } else {
        header("Location: signup.php?error=Invalid user type.");
        exit();
    }

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        if ( $user_type == 'student') {
            $_SESSION['student_id'] = $stmt->insert_id;
            $_SESSION['name'] = $name; // Store the name in session
            $_SESSION['email'] = $email; // Store the email in session
            header("Location: student/studentRegistration.php");
        } elseif ($user_type == 'coordinator') {
            $_SESSION['coordinator_id'] = $stmt->insert_id;
            $_SESSION['name'] = $name; // Store the name in session
            $_SESSION['email'] = $email; // Store the email in session
            header("Location: coordinator/dashboard.php");
        } elseif ($user_type == 'organisation') {
            $_SESSION['organisation_id'] = $stmt->insert_id;
            $_SESSION['name'] = $name; // Store the name in session
            $_SESSION['email'] = $email; // Store the email in session
            header("Location: organisation/dashboard.php");
        }
        exit();
    } else {
        // Handle error
        header("Location: signup.php?error=Error creating account. Please try again.");
        exit();
    }

    // Close the statement and connection
    $stmt->close();
} else {
    // If the form is not submitted, redirect to the signup page
    header("Location: signup.php");
    exit();
}