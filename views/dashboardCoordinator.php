<?php
session_start();

if (!isset($_SESSION['coordinator_id'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['coordinator_id'];
$username = $_SESSION['name'];
$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>IAMS Dashboard</title>
  <link rel="stylesheet" href="/public/css/index.css">
  <link rel="stylesheet" href="/public/css/dashboard.css">
  <script src="/public/js/dashboard.js"></script>
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
        <button class="nav-btn"><i class="icon">🏠</i> <a href="homeCoordinator.php">Home</a></button>
        <button class="nav-btn active"><i class="icon">📊</i> Dashboard</button>
        <button class="nav-btn"><i class="icon">⚙️</i> Settings</button>
        <button class="nav-btn"><i class="icon">🔔</i> Notifications</button>
        <button class="nav-btn"><i class="icon">🔓</i><a href="../logout.php">logout</a></button>
      </nav>
    </aside>

    <main class="main-content">
      <div class="card" onclick="showOverlay('Logbooks')">
        <p>Logbooks</p> 
        <i class="icon">📘</i>
      </div>
      <div class="card" onclick="showOverlay('Assessment reports')">
        <p>Assessment reports</p>
        <i class="icon">📄</i>
      </div>
    </main>

    <section id="logbooks" class="overlay" style="display: none;">
      <div class="overlay-content">
        <span class="close-icon" onclick="closeOverlay()">&times;</span>
        <span id="overlay-text"></span>
      </div>
    </section>

    <section id="reports" class="overlay" style="display: none;">
      <div class="overlay-content">
        <span class="close-icon" onclick="closeOverlay()">&times;</span>
        <span id="overlay-text"></span>
      </div>
    </section>

  </div>
</body>

</html>