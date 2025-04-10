<?php

function getDatabase() {
// Database details
$servername = "localhost";
$username = "root";
$password = "";
$database = "test_db";

// Connect to MySQL DB
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists, if not create it
$conn->query("CREATE DATABASE IF NOT EXISTS $database") or die("Database creation failed: " . $conn->error);

// Select the database
$conn->select_db($database);

// Check if the database is selected successfully
if ($conn->connect_error) {
    die("Database selection failed: " . $conn->connect_error);
}

return $conn;
}
?>