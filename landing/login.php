<?php
// login.php
    // login.php
    session_start();
    $_SESSION['username'] = $row['full_name'];  // e.g., "Mary Atieno"
    header("Location: dashboard.php"); // go to the dashboard
    exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up | Academic Attachment Portal</title>
  <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
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

    input {
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
    <form action="signup_process.php" method="POST" onsubmit="return validateSignup(event)">
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
      </div>
      <button type="submit" class="btn-create">Create Account</button>
    </form>
  </div>

  <script>
    function validateSignup(e) {
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const confirmPassword = document.getElementById('confirm_password').value.trim();

      const emailPattern = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;
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
