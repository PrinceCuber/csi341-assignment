<?php
require_once 'Config/util.php'; // Include your database connection file
require_once 'Config/helper.php';

if (isset($_SESSION['student_id'])) {
  header('Location: student/dashboard.php');
  exit;
} elseif (isset($_SESSION['organisation_id'])) {
  header('Location: organisation/dashboard.php');
  exit;
} elseif (isset($_SESSION['coordinator_id'])) {
  header('Location: coordinator/dashboard.php');
  exit;
}

$conn = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = test_input($_POST['name']);
  $email = test_input($_POST['email']);
  $password = test_input($_POST['password']);
  $confirm_password = test_input($_POST['confirm_password']);
  $role = test_input($_POST['role']);

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: signup.php?error=invalid_email');
    exit();
  } elseif ($password !== $confirm_password) {
    header('Location: signup.php?error=password_mismatch');
    exit();
  } elseif (strlen($password) < 6) {
    header('Location: signup.php?error=password_too_short');
    exit();
  } elseif (emailExist($email)) {
    header('Location: signup.php?error=email_exists');
    exit();
  } elseif (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    header('Location: signup.php?error=empty_fields');
    exit();
  } else {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if ($role === 'student') {
      $stmt = $conn->prepare("INSERT INTO students (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss",$name, $email, $hashed_password);
      $stmt->execute();
      $_SESSION['student_id'] = $conn->insert_id;
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $name;
      header('Location: student/dashboard.php');
      exit();
    } elseif ($role === 'organisation') {
      $stmt = $conn->prepare("INSERT INTO organisations (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss",$name, $email, $hashed_password);
      $stmt->execute();
      $_SESSION['organisation_id'] = $conn->insert_id;
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $name;
      header('Location: organisation/dashboard.php');
      exit();
    } elseif ($role === 'coordinator') {
      $stmt = $conn->prepare("INSERT INTO coordinators (name, email, password) VALUES (?, ?, ?)");
      $stmt->bind_param("sss",$name, $email, $hashed_password);
      $stmt->execute();
      $_SESSION['coordinator_id'] = $conn->insert_id;
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $name;
      die("here");
      header('Location: coordinator/dashboard.php');
      exit();
    } else {
      header('Location: signup.php?error=invalid_role');
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | Academic Attachment Portal</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
      width: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, rgba(0, 90, 156, 0.5), rgba(163, 209, 247, 0.5));
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .signup-box {
      background-color: rgba(0, 0, 50, 0.6);
      padding: 60px 50px;
      border-radius: 12px;
      width: 90%;
      max-width: 600px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 2rem;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    label {
      margin-bottom: 6px;
      display: block;
      font-size: 1rem;
    }

    input,
    select {
      padding: 14px;
      border-radius: 8px;
      border: none;
      font-size: 1rem;
      width: 100%;
    }

    input::placeholder {
      color: #aaa;
    }

    .password-wrapper {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 16px;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #fff;
      font-size: 0.9rem;
      cursor: pointer;
    }

    .btn-create {
      padding: 14px;
      font-weight: bold;
      cursor: pointer;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      background-color: #007bff;
      color: white;
      transition: background-color 0.3s;
      margin-top: 10px;
    }

    .btn-create:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>
  <div class="signup-box">
    <h2>Create Your Account</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" onsubmit="return validateSignup(event)">
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="John Doe" required>
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
      </div>
      <div>
        <label for="password">Password</label>
        <div class="password-wrapper">
          <input type="password" name="password" id="password" placeholder="********" required>
          <button type="button" class="toggle-password" onclick="togglePassword('password')">Show</button>
        </div>
      </div>
      <div>
        <label for="confirm_password">Confirm Password</label>
        <div class="password-wrapper">
          <input type="password" name="confirm_password" id="confirm_password" placeholder="********" required>
          <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">Show</button>
        </div>
        <div>
          <label for="role">Role</label>
          <div class="password-wrapper">
            <select name="role" id="role" required>
              <option value="" disabled selected>Select your role</option>
              <option value="student">Student</option>
              <option value="organisation">Organisation</option>
              <option value="coordinator">Coordinator</option>
            </select>
          </div>
        </div>
      </div>
      <button type="submit" class="btn-create">Create Account</button>
    </form>
  </div>

  <script>
    function validateSignup(e) {
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const confirmPassword = document.getElementById('confirm_password').value.trim();

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      console.log(emailPattern.test(email));
      console.log(email);
      if (!emailPattern.test(email)) {
        alert('Please enter a valid email.');
        e.preventDefault();
        return false;
      }

      if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        e.preventDefault();
        return false;
      }

      if (password !== confirmPassword) {
        alert('Passwords do not match.');
        e.preventDefault();
        return false;
      }

      return true;
    }

    function togglePassword(id) {
      const field = document.getElementById(id);
      const button = field.nextElementSibling;
      if (field.type === "password") {
        field.type = "text";
        button.textContent = "Hide";
      } else {
        field.type = "password";
        button.textContent = "Show";
      }
    }
  </script>
</body>

</html>