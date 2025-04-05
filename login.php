<?php
session_start();

// Connect to SQLite DB
$db = new PDO('sqlite:mydb.sqlite');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = htmlspecialchars(trim($_POST["email"]));
  $password = $_POST["password"];

  // Query user by email
  $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    // Password is correct, set session and redirect
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Invalid email or password!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAMS: Login</title>
  </head>
  <body>
    <fieldset>
      <legend>Login</legend>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
      </form>
    </fieldset>
  </body>
</html>
