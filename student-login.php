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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars(trim($_POST["email"]));
  $password = $_POST["password"];

  // Query user by email
  $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows == 1) {
    $stmt->bind_result($id, $username,$hashed);
    $stmt->fetch();

    // Password is correct, set session and redirect
    if(password_verify($password, $hashed)) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      header("Location: dashboard.php");
      exit();
    } else {
      echo "Invalid email or password";
    }
  } else {
    echo "Invalid email or password!";
  }

  $stmt->close();
}

$conn->close();
?>
