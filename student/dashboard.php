<?php
session_start();

if (!isset($_SESSION['student_id'])) {
  header("Location: ../login.php");
  exit();
}

$user_id = $_SESSION['student_id'];
$username = $_SESSION['name'];
$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>IAMS Dashboard</title>
  <link rel="stylesheet" href="../public/css/index.css">
  <link rel="stylesheet" href="../public/css/dashboard.css">
  <script src="../public/js/dashboard.js"></script>
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
        <a href="homeStudent.php" class="nav-btn"><i class="icon">🏠</i> Home</a>
        <a class="nav-btn active"><i class="icon">📊</i> Dashboard</a>
        <a href="#" class="nav-btn"><i class="icon">⚙️</i> Settings</a>
        <a href="../logout.php" class="nav-btn"><i class="icon">🔓</i>Logout</a>
      </nav>
    </aside>

    <main class="main-content">
      <p>Notification</p>
      <p>Application</p>
      <p>Progress to applying</p>
      <p>Logbook</p>
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