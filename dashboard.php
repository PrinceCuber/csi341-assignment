<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connect to SQLite DB
$db = new PDO('sqlite:mydb.sqlite');

// Get the logged-in user's details from the session
$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Display user details
echo "<h1>Welcome, " . htmlspecialchars($user['username']) . "!</h1>";
echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAMS: Login</title>
  </head>
  <body>
    <a href="logout.php">Logout</a>
  </body>
</html>

