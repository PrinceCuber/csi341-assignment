<?php
session_start();
// Connect to SQLite DB
$db = new PDO('sqlite:mydb.sqlite');

// Create tables if they don't exist
$db->exec("
  CREATE TABLE IF NOT EXISTS users (
  user_id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE,
  email TEXT,
  password TEXT,
  role_id INTEGER
  );
  ");

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = htmlspecialchars(trim($_POST["username"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  // Insert user
  $stmt = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  if ($stmt->execute([$username, $email, $password])) {
    $user_id = $db->lastInsertId();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Error: " . implode(", ", $stmt->errorInfo());
  }
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IAMS: Sign Up</title>
  </head>
  <body>
    <fieldset>
      <legend>Sign up</legend>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Sign Up</button>
      </form>
    </fieldset>
  </body>
</html>
