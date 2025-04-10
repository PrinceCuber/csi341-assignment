<?php
session_start();

// Database details
$servername = "localhost";
$username = "root";
$password = "";
$database = "test_db";

// Connect to MySQL DB
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($database);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = $_POST["password"];

    // Query user by email
    $stmt = $conn->prepare("SELECT user_id, username, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    if(!$stmt->execute()) {
      die("Query execution failed: " . $stmt->error);
    }
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $db_email, $hashed);
        $stmt->fetch();

        echo "username" . $username . "email: " . $email ;
        // Password is correct, set session and redirect
        if (password_verify($password, $hashed)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $db_email; // Use the email fetched from the database
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password!";
    }

    $stmt->close();
}

$conn->close();
?>
