<?php
// signup.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Academic Attachment Portal</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    html, body {
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, rgba(0, 90, 156, 0.5), rgba(100, 179, 244, 0.5));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }
    .signup-box {
      background-color: rgba(0, 0, 50, 0.6);
      padding: 60px;
      border-radius: 16px;
      width: 95%;
      max-width: 700px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }
    h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2.2rem;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 22px;
    }
    label {
      font-size: 1rem;
      margin-bottom: 8px;
    }
    input[type="email"],
    input[type="password"] {
      padding: 14px;
      border-radius: 8px;
      border: none;
      font-size: 1rem;
      width: 100%;
    }
    .password-wrapper {
      position: relative;
    }
    .toggle-password {
      position: absolute;
      top: 50%;
      right: 16px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 14px;
      background: none;
      border: none;
      color: #fff;
    }
    input::placeholder {
      color: #ccc;
    }
    .btn-create {
      padding: 16px;
      font-weight: bold;
      cursor: pointer;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      background-color: #28a745;
      color: white;
      transition: background-color 0.3s;
      margin-top: 10px;
    }
    .btn-create:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
  <div class="signup-box">
    <h2>Create Your Account</h2>
    <form action="signup_process.php" method="POST" onsubmit="return validateSignup()">
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
    function validateSignup() {
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const confirmPassword = document.getElementById('confirm_password').value.trim();

      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        alert('Please enter a valid email.');
        return false;
      }

      if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return false;
      }

      if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
      }

      return true;
    }

    function togglePassword(id) {
      const field = document.getElementById(id);
      const toggleBtn = field.nextElementSibling;
      if (field.type === 'password') {
        field.type = 'text';
        toggleBtn.textContent = 'Hide';
      } else {
        field.type = 'password';
        toggleBtn.textContent = 'Show';
      }
    }
  </script>
</body>
</html>
