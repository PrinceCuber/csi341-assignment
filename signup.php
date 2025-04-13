<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = "localhost";
    $dbname = "your_database_name";
    $username = "your_db_username";
    $password = "your_db_password";

    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $org_name = $_POST['org_name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $tech_preferences = $_POST['tech_preferences'];
    $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO organizations (org_name, email, location, tech_preferences, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $org_name, $email, $location, $tech_preferences, $password_hashed);

    if ($stmt->execute()) {
        $message = "Organization registered successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Organization Sign Up</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Organization Sign Up</h2>
    
    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <form method="POST" action="">
      <input type="text" name="org_name" placeholder="Organization Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="location" placeholder="Location" required>
      <input type="text" name="tech_preferences" placeholder="Tech Preferences" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="org_login.html">Login</a></p>
  </div>
</body>
</html>
