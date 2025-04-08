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

// Create database if it doesn't exist
$conn->query("CREATE DATABASE IF NOT EXISTS $database");

// Select the database
$conn->select_db($database);

// Create tables if they don't exist
$conn->query("
  CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255),
    password TEXT
  );
");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = htmlspecialchars(trim($_POST["username"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // Insert user
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password);
  if ($stmt->execute()) {
    $user_id = $conn->insert_id; // Get the last inserted ID
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
