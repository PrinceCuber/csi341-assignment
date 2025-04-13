<?php
session_start();

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

    $email = $_POST['email'];
    $password_input = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, org_name, password FROM organizations WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $org_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password_input, $hashed_password)) {
            $_SESSION['org_id'] = $id;
            $_SESSION['org_name'] = $org_name;
            $message = "Login successful! Welcome, " . htmlspecialchars($org_name) . ".";
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No organization found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Organization Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Organization Login</h2>

    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <form method="POST" action="">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="org_signup.php">Sign Up</a></p>
  </div>
</body>
</html>
