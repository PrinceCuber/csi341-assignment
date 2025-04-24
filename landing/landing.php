<?php
// landing.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Attachment Portal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, rgba(0, 90, 156, 0.5),  rgba(163, 209, 247, 0.5));
            color: white;
            display: flex;
            flex-direction: column;
        }
        .con {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 60px;
            background-color: rgba(0, 0, 50, 0.5);
            border-radius: 12px;
            margin: auto;
            max-width: 1000px;
            width: 90%;
        }
        .con .text {
            max-width: 50%;
        }
        .con h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .con p {
            font-size: 1rem;
            opacity: 0.9;
        }
        .con img {
            max-width: 45%;
            border-radius: 10px;
            opacity: 0.5;
        }
        .login-btn {
            display: block;
            margin: 40px auto;
            padding: 14px 30px;
            background-color: white;
            color: #005a9c;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .login-btn:hover {
            background-color: #e2e2e2;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.3);
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="con">
        <div class="text">
            <h1>Welcome to Academic Attachment Portal!</h1>
            <p>Connecting students with organizations for meaningful industrial experience.</p>
        </div>
        <img src="https://static.vecteezy.com/system/resources/previews/014/577/352/original/connection-3d-icon-png.png" alt="Portal Illustration">
    </div>

    <a href="login.php" class="login-btn">Login</a>

    <footer>
        &copy; <?php echo date("Y"); ?> Academic Attachment Portal. All rights reserved.
    </footer>
</body>
</html>
