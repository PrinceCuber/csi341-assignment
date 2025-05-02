<?php
require_once '../Config/util.php';
require_once '../Config/helper.php';

session_start();

if (!isset($_SESSION['coordinator_id'])) {
  header("Location: ../login.php");
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
  <link rel="stylesheet" href="../public/css/index.css">
  <link rel="stylesheet" href="../public/css/dashboard.css">
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
        <a href="homeCoordinator.php" class="nav-btn"><i class="icon">🏠</i>Home</a>
        <a class="nav-btn active"><i class="icon">📊</i> Dashboard</a>
        <a class="nav-btn"><i class="icon">⚙️</i> Settings</a>
        <a class="nav-btn"><i class="icon">🔔</i> Notifications</a>
        <a href="../logout.php" class="nav-btn"><i class="icon">🔓</i>logout</a>
      </nav>
    </aside>

    <main class="main-content">
      <header class="header">Industrial Attachment Management System (IAMS)</header>
      <button>Match students automatically</button>
      <p>filter</p>
      <?php
      $conn = getDatabase();
      $sql = "SELECT s.* 
              FROM students s 
              INNER JOIN attachments a ON s.student_id = a.student_id 
              WHERE a.complete = 1";

      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        echo "<h2>Students List</h2>";
        // Fetch all students
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
          // Make the whole row clickable
          echo "<tr onclick=\"window.location.href='student.php?id=" . $row['student_id'] . "'\">";
          echo "<td>" . htmlspecialchars($row['name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['email']) . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      } else {
        echo "<p>No students found.</p>";
      }
      ?>
    </main>
  </div>

<!-- Add this script to your HTML file -->
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