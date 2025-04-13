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
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS attachments (
            attachment_id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT NOT NULL,
            id_num VARCHAR(255) NOT NULL,
            phone_number VARCHAR(255) NOT NULL,
            dob DATE NOT NULL,
            attachment_start_date DATE NOT NULL,
            attachment_end_date DATE NOT NULL,
            location VARCHAR(255) NOT NULL,
            skills TEXT NOT NULL,
            doc_path VARCHAR(255) NOT NULL,
            emergency_contact_name VARCHAR(255) NOT NULL,
            emergency_contact_phone VARCHAR(255) NOT NULL,
            emergency_contact_relationship VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
        )";
    $conn->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS organisation_registration (
            registration_id INT AUTO_INCREMENT PRIMARY KEY,
            organisation_id INT NOT NULL,
            contact_person VARCHAR(255) NOT NULL,
            contact_email VARCHAR(255) NOT NULL,
            slots INT NOT NULL,
            skills TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (organisation_id) REFERENCES organisations(organisation_id) ON DELETE CASCADE
        )";
    $conn->query($sql);

    return $conn;
}
