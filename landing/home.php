<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Industrial Attachment Portal</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, rgba(0, 90, 156, 0.5), rgba(100, 179, 244, 0.5));
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 260px;
      background: linear-gradient(to bottom right, #01579b, #004d40);
      color: white;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .user-profile {
      text-align: center;
      margin-bottom: 50px;
    }

    .user-profile i {
      font-size: 60px;
      margin-bottom: 15px;
    }

    .user-profile p {
      margin: 0;
      font-weight: bold;
      font-size: 18px;
    }

    .menu {
      width: 100%;
    }

    .menu a {
      display: flex;
      align-items: center;
      color: white;
      text-decoration: none;
      padding: 12px 15px;
      border-radius: 8px;
      transition: background 0.3s;
      margin-bottom: 10px;
      font-size: 16px;
    }

    .menu a i {
      margin-right: 12px;
      font-size: 18px;
    }

    .menu a:hover,
    .menu a.active {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .content {
      flex: 1;
      padding: 60px 80px;
      overflow-y: auto;
    }

    .content h1 {
      color: #004d40;
      font-size: 36px;
      margin-bottom: 20px;
    }

    .welcome-box {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .welcome-box p {
      font-size: 18px;
      color: #004d40;
      line-height: 1.6;
    }
  </style>
</head>
<body>
  <?php session_start(); ?>
  <div class="container">
    <div class="sidebar">
      <div class="user-profile">
        <i class="fas fa-user-circle"></i>
        <p><?php echo htmlspecialchars($_SESSION['username'] ?? 'User Name'); ?></p>
      </div>
      <div class="menu">
        <a href="#" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-calendar"></i> Calendar</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </div>
    <div class="content">
      <h1>Welcome to the Academic Attachment Portal</h1>
      <div class="welcome-box">
        <p>
          Welcome to the Industrial Attachment Management System! This platform is designed to streamline the communication and coordination between students, supervisors, and the department. Use the sidebar to navigate to your dashboard, view upcoming calendar events, update your settings, or log out of your session.
        </p>
        <p>
          If you're a student, be sure to update your weekly logbook and submit your reports on time. Supervisors can track student activities and provide assessments directly through their dashboard. Let's make the most of your industrial attachment experience!
        </p>
      </div>
    </div>
  </div>
</body>
</html>
