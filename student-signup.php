<?php
session_start();

// Database details
$servername = $_ENV['DBSERVER'];
$username = $_ENV['DBUSER'];
$password = $_ENV['DBPASS'];
$database = $_ENV['DBDATABASE'];
// Connect to SQLite DB
$conn = new mysqli($servername,$username, $password);

if($conn->connect_error) {
  die("Connection failed:" . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $database");

$conn->select_db($database);
// Create tables if they don't exist
$db->query("
  CREATE TABLE IF NOT EXISTS users (
  user_id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE,
  email TEXT,
  password TEXT,
  );
  ");

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = htmlspecialchars(trim($_POST["username"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // Insert user
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password);
  if ($stmt->execute()) {
    $user_id = $db->lastInsertId();
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
