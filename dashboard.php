<?php
session_start();

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the logged-in user's details from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Display user details
echo "<h1>Welcome, " . htmlspecialchars($username) . "!</h1>";
echo "<p>Email: " . htmlspecialchars($email) . "</p>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAMS: Dashboard</title>
</head>
<body>
    <a href="logout.php">Logout</a>
</body>
</html>

