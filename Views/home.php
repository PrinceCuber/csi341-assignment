<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: student-login.html");
  exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>IAMS Dashboard</title>
  <link rel="stylesheet" href="/public/css/dashboard.css">
</head>

<body>
  <header class="header">Industrial Attachment Management System (IAMS)</header>
  <div class="container">
    <aside class="sidebar">
      <div class="user-profile">
        <img src="user-icon.png" alt="User icon" class="profile-pic">
        <p class="user-name"><?php echo $username ?></p>
        <hr>
      </div>

      <nav class="nav-menu">
        <button class="nav-btn active"><i class="icon">🏠</i> home</button>
        <button class="nav-btn"><i class="icon">📊</i><a href="dashboard.php">Dashboard</a></button>
        <button class="nav-btn"><i class="icon">⚙️</i> Settings</button>
        <button class="nav-btn"><i class="icon">🔔</i> Notifications</button>
        <button class="nav-btn"><i class="icon">🔓</i><a href="../logout.php">logout</a></button>
      </nav>
    </aside>

    <main class="main-content">
    <p>Organisation list</p>
    </main>
  </div>
</body>

</html>