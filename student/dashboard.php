<?php
require_once '../Config/util.php';
require_once '../Config/helper.php';

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
  <link rel="stylesheet" href="../public/css/studentMain.css">
  <script src="../public/js/dashboard.js"></script>
</head>

<body>
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
      <!-- <header class="header">Industrial Attachment Management System (IAMS)</header> -->
      <div class="layout">
        <div>
          <?php
          // Check if student has completed the application
          $conn = getDatabase();

          $query = "SELECT completed FROM attachments WHERE student_id = ?";
          if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($completed);
            $stmt->fetch();
            $stmt->close();
          }
          if ($completed) {
            echo "<p class='completed'>Application Completed</p>";
          } else {
            echo "<p class='not-completed'>Application Not Completed</p>";
            echo "<a href='studentRegistration.php' class='btn'>Complete Application</a>";
          }
          ?>
          <p>Application</p>
          <p>Logbook</p>

        </div>
        <p>Notification</p>
      </div>
    </main>

    <div id="overlay" class="overlay" style="display: none;">
      <div class="overlay-content">
        <span id="overlay-text"></span>
        <button onclick="closeOverlay()">Close</button>
      </div>
    </div>
  </div>
  <script>
    const themeToggle = document.createElement('button');
    themeToggle.textContent = 'Toggle Theme';
    themeToggle.style.position = 'fixed';
    themeToggle.style.top = '10px';
    themeToggle.style.right = '10px';
    document.body.appendChild(themeToggle);

    themeToggle.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
      localStorage.setItem('theme', theme);
    });

    // Load saved theme from localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
    }
  </script>
</body>

</html>