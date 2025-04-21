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

    // Validate the input
    if (empty($email) || empty($password)) {
        header("Location: login.html?error=All fields are required.");
        exit();
    }

    // Connect to the database
    $conn = getDatabase();

    // Check if the user is a student
    $stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: student/dashboard.php");
            exit();
        } else {
            header("Location: login.html?error=Invalid email or password.");
            exit();
        }
    } else {
        header("Location: login.html?error=Invalid email or password.");
        exit();
    }

    // Check if the user is a coordinator
    $stmt = $conn->prepare("SELECT * FROM coordinators WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['coordinator_id'] = $user['coordinator_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: coordinator/dashboard.php");
            exit();
        } else {
            header("Location: login.html?error=Invalid email or password.");
            exit();
        }
    } else {
        header("Location: login.html?error=Invalid email or password.");
        exit();
    }

    // Check if the user is an organisation
    $stmt = $conn->prepare("SELECT * FROM organisations WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['organisation_id'] = $user['organisation_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: organisation/dashboard.php");
            exit();
        } else {
            header("Location: login.html?error=Invalid email or password.");
            exit();
        }
    } else {
        header("Location: login.html?error=Invalid email or password.");
        exit();
    }

} else {
    // If the form is not submitted, show the login page
    header("Location: login.html");
    exit();
}
?>