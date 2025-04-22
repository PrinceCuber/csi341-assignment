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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Academic Attachment Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            width: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, rgba(0, 90, 156, 0.5), rgba(100, 179, 244, 0.5));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }
        .login-box {
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
        input, select {
            padding: 14px;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
        }
        input::placeholder {
            color: #aaa;
        }
        select {
            background-color: white;
            color: #333;
        }
        .button-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 10px;
        }
        .btn {
            flex: 1;
            padding: 14px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            text-align: center;
            transition: background-color 0.3s;
        }
        .login {
            background-color: white;
            color: #005a9c;
        }
        .login:hover {
            background-color: #e2e2e2;
        }
        .signup {
            background-color: #007bff;
            color: white;
        }
        .signup:hover {
            background-color: #0056b3;
        }
        a.signup {
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login to Your Account</h2>
        <form action="login_process.php" method="POST" onsubmit="return validateLogin()">
            <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
            <input type="password" name="password" id="password" placeholder="********" required>
            <select name="role" id="role" required>
                <option value="">Select your role</option>
                <option value="student">Student</option>
                <option value="industrial_supervisor">Industrial Supervisor</option>
                <option value="university_coordinator">University Coordinator</option>
            </select>
            <div class="button-row">
                <button type="submit" class="btn login">Login</button>
                <a href="signup.php" class="btn signup">Sign Up</a>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <a href="forgot_password.php" style="color: #ffffffcc; font-size: 0.9rem; text-decoration: underline;">Forgot Password?</a>
            </div>
        </form>
    </div>

    <script>
        function validateLogin() {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const role = document.getElementById('role').value;

            if (!email || !password || !role) {
                alert('Please fill in all fields.');
                return false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
