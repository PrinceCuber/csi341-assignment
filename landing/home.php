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
      flex-direction: column;
    }

    .sidebar {
      width: 260px;
      background: linear-gradient(to bottom right, #01579b, #004d40);
      color: white;
      padding: 30px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: fixed;
      height: 100%;
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
      margin-left: 260px; /* Space for sidebar */
      padding: 60px 80px;
      overflow-y: auto;
      background-color: white;
      color: #004d40;
    }

    .content h1 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .welcome-box {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .footer {
      background-color: #004d40;
      color: white;
      text-align: center;
      padding: 20px;
      position: fixed;
      width: 100%;
      bottom: 0;
    }

    .footer a {
      color: white;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    .footer p {
      margin: 0;
    }
  </style>
</head>
<body>
  <?php session_start(); ?>
  <div class="container">
    <!-- Sidebar -->
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

    <!-- Content -->
    <div class="content">
      <h1 style="text-align: center;">Welcome to the Academic Attachment Portal</h1>
      <div class="welcome-box">
        <p>
          Welcome to the Industrial Attachment Management System! This platform streamlines communication and coordination between students, supervisors, and your department.
        </p>
        <p>
          As a student, remember to log your weekly activities and submit reports promptly. Supervisors can assess students directly through their dashboards. Use the sidebar to navigate around.
        </p>
        <p>
          Let’s make your industrial attachment journey organized and impactful!
        </p>
      </div>

      <h2>How It Works</h2>
      <p>
        The portal allows students to log their activities and submit reports, making it easier for supervisors to review their progress. Supervisors can assess performance and provide feedback. The department can track all activities and ensure compliance with attachment guidelines.
      </p>

      <h2>Get Started</h2>
      <p>
        To start using the platform, log in and ensure your profile is up to date. If you are a student, make sure to begin logging your activities and submitting your weekly reports.
      </p>

      <h2>Benefits for Students</h2>
      <ul>
        <li>Track your weekly activities and progress.</li>
        <li>Submit reports and receive feedback from your supervisors.</li>
        <li>Stay organized with easy access to important deadlines and tasks.</li>
        <li>Collaborate with your supervisor and department in real-time.</li>
      </ul>

      <h2>Features for Supervisors</h2>
      <p>
        Supervisors can easily monitor student progress through the portal. Track weekly logs, view submitted reports, and provide valuable feedback to ensure that students are on track with their industrial attachment requirements.
      </p>

      <h2>Important Dates</h2>
      <ul>
        <li>Weekly report submission deadline: Every Friday, 5:00 PM</li>
        <li>Final assessment review: June 1st, 2025</li>
        <li>End of attachment period: July 31st, 2025</li>
      </ul>

      <h2>Frequently Asked Questions</h2>
      <div>
        <h3>How do I update my profile?</h3>
        <p>
          To update your profile, simply navigate to the "Settings" tab in the sidebar. Here you can change your personal information, upload documents, and more.
        </p>
      </div>
      <div>
        <h3>Can I submit my reports directly through the portal?</h3>
        <p>
          Yes, students can upload and submit their weekly reports directly through the portal, which will be reviewed by your assigned supervisor.
        </p>
      </div>

      <h2>Contact Us</h2>
      <p>
        If you have any questions or need assistance, please feel free to contact us at <a href="mailto:support@attachmentportal.com">support@attachmentportal.com</a>.
      </p>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>&copy; 2025 Industrial Attachment Portal. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
  </div>
</body>
</html>
