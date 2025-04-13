<?php
session_start();

if (!isset($_SESSION['organisation_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['organisation_id'];
$username = $_SESSION['name'];
$email = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IAMS Dashboard</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/dashboard.css">
    <link rel="stylesheet" href="/public/css/org.css">
    <script src="/public/js/dashboard.js"></script>
</head>

<body>
    <header class="header">Industrial Attachment Management System (IAMS)</header>
    <div class="container">

        <aside class="sidebar">
            <div class="user-profile">
                <img src="user-icon.png" alt="User icon" class="profile-pic">
                <p class="user-name"><?php echo $username ?></p>
                <hr>
            </div>

            <nav class="nav-menu">
                <button class="nav-btn active"><i class="icon">📊</i> Dashboard</button>
                <button class="nav-btn"><i class="icon">⚙️</i> Settings</button>
                <button class="nav-btn"><i class="icon">🔓</i><a href="../logout.php">logout</a></button>
            </nav>
        </aside>

        <main class="main-content">
            <div class="card" onclick="showOverlay('Attachment post')">
                <p>Attachment Post</p>
                <i class="icon">📘</i>
            </div>
            <div class="card" onclick="showOverlay('Assessment reports')">
                <p>Assessment reports</p>
                <i class="icon">📄</i>
            </div>
        </main>

        <section id="post" class="overlay" style="display: none;">
            <div class="overlay-content">
                <span class="close-icon" onclick="closeOverlay()">&times;</span>
                <span id="overlay-text"></span>
                <fieldset>
                    <legend>Organization Registration Form</legend>
                    <form action="/routing.php?action=organisation_registration" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">

                        <label for="org_name">Organization Name:</label>
                        <input type="text" id="org_name" name="org_name" required>

                        <label for="industry_type">Industry Type:</label>
                        <input type="text" id="industry_type" name="industry_type" required>

                        <label for="location">Location/Region:</label>
                        <input type="text" id="location" name="location" required>

                        <label for="contact_person">Contact Person Name:</label>
                        <input type="text" id="contact_person" name="contact_person" required>

                        <label for="contact_email">Contact Email:</label>
                        <input type="email" id="contact_email" name="contact_email" required>

                        <label for="contact_phone">Contact Phone Number:</label>
                        <input type="tel" id="contact_phone" name="contact_phone" required>

                        <label for="tech_skills">Preferred Student Skills/Technologies:</label>
                        <input type="text" id="skills" name="skills" required>

                        <label for="slots">Number of Students You Can Host:</label>
                        <input type="number" id="slots" name="slots" min="1" required>

                        <label for="projects">Project Areas Available:</label>
                        <textarea id="projects" name="projects" rows="4" cols="50"></textarea>

                        <label for="requirements_doc">Upload Requirements Document (PDF only):</label>
                        <input type="file" id="requirements_doc" name="requirements_doc" accept=".pdf"><br>

                        <input type="submit" value="Register Organization">
                    </form>
                </fieldset>
            </div>
        </section>

        <section id="reports" class="overlay" style="display: none;">
            <div class="overlay-content">
                <span class="close-icon" onclick="closeOverlay()">&times;</span>
                <span id="overlay-text"></span>
            </div>
        </section>

    </div>
</body>

</html>