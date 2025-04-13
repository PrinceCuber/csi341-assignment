<?php

function getDatabase()
{
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

    // TODO: only for development, remove in production
    $sql = "CREATE TABLE IF NOT EXISTS students (
            student_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS coordinators (
            coordinator_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS organisations (
            organisation_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            location VARCHAR(255) NOT NULL,
            tech_preferences TEXT NOT NULL,
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $conn->query($sql);

    return $conn;
}
