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
        <button class="nav-btn"><i class="icon">🏠</i> <a href="home.php">Home</a></button>
        <button class="nav-btn active"><i class="icon">📊</i> Dashboard</button>
        <button class="nav-btn"><i class="icon">⚙️</i> Settings</button>
        <button class="nav-btn"><i class="icon">🔔</i> Notifications</button>
        <button class="nav-btn"><i class="icon">🔓</i><a href="../logout.php">logout</a></button>
      </nav>
    </aside>

    <main class="main-content">
      <div class="card" onclick="showOverlay('Student overview')">Student overview</div>
      <div class="card" onclick="showOverlay('Assessment report')">Assessment report</div>
      <div class="card" onclick="showOverlay('Logbook tracker')">Logbook tracker</div>
      <div class="card" onclick="showOverlay('Reminders')">Reminders</div>
      <div class="card" onclick="showOverlay('Upcoming visit')">Upcoming visit</div>
    </main>

    <div id="overlay" class="overlay" style="display: none;">
      <div class="overlay-content">
        <span id="overlay-text"></span>
        <button onclick="closeOverlay()">Close</button>
      </div>
    </div>
  </div>
</body>

</html>