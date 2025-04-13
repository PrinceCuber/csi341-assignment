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
        <a href="homeCoordinator.php" class="nav-btn"><i class="icon">🏠</i>Home</a>
        <a class="nav-btn active"><i class="icon">📊</i> Dashboard</a>
        <a class="nav-btn"><i class="icon">⚙️</i> Settings</a>
        <a class="nav-btn"><i class="icon">🔔</i> Notifications</a>
        <a href="../logout.php" class="nav-btn"><i class="icon">🔓</i>logout</a>
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
      <div class="card" onclick="showOverlay('Students')">
        <p>Students</p>
        <i class="icon">👨‍🎓</i>
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


    <section id="students" class="overlay" style="display: none;">
      <div class="overlay-content">
        <span class="close-icon" onclick="closeOverlay()">&times;</span>
        <span id="overlay-text"></span>
        <div>
          <?php
          // Database connection
          include_once '../Models/Student.php';
          include_once '../Models/Organisation.php';

          $students = Student::getAllStudents(); // Assuming you have a method to fetch all students
          if (!$students) {
            echo "No students found.";
          }

          if ($students) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Email</th><th>Actions</th></tr>";
            foreach ($students as $student) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($student['name']) . "</td>";
              echo "<td>" . htmlspecialchars($student['email']) . "</td>";
              echo "<td>
                <form method='POST' style='display:inline;'>
            <input type='hidden' name='student_id' value='" . $student['student_id'] . "'>
            <button type='submit'>View Organisations</button>
                </form>
              </td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "No students found.";
          }

          // Handle form submission for viewing organisations
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
            $studentId = $_POST['student_id'];
            $organisations = Organisation::getAllOrganisations(); 

            echo "<div id='organisations-list'>";
            if ($organisations) {
              foreach ($organisations as $org) {
          echo "<div>";
          echo "<p><strong>" . htmlspecialchars($org['name']) . "</strong></p>";
          echo "<form method='POST' action='../Controllers/acceptOrganisation.php' style='display:inline;'>
            <input type='hidden' name='org_id' value='" . $org['organisation_id'] . "'>
            <input type='hidden' name='student_id' value='" . $studentId . "'>
            <button type='submit'>Accept</button>
                </form>";
          echo "<form method='POST' action='../Controllers/denyOrganisation.php' style='display:inline;'>
            <input type='hidden' name='org_id' value='" . $org['organisation_id'] . "'>
            <input type='hidden' name='student_id' value='" . $studentId . "'>
            <button type='submit'>Deny</button>
                </form>";
          echo "</div>";
              }
            } else {
              echo "<p>No organisations found.</p>";
            }
            echo "</div>";
          }
          ?>
        </div>
      </div>
    </section>

    

  </div>
</body>

</html>