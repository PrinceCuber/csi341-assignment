<?php
session_start();
session_destroy(); // Destroy the session to log out the user
header("Location: Views/student-login.html"); // Redirect to the login page
exit();
?>
