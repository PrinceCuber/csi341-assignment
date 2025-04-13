<?php

include_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../Models/Student.php';
include_once __DIR__ . '/../Models/Coordinator.php';

// helpers/util.php
// This file contains utility functions for database connection and other common tasks
class Util {
    // Method to check if the email already exists
    /**
     * Checks if the given email exists in the students or coordinators table.
     *
     * @param string $email The email address to check.
     * @return bool True if the email exists, false otherwise.
     * @throws Exception If the database connection fails.
     */
    public static function emailExists($email) {
        $conn = getDatabase();
        if (!$conn) {
            throw new Exception("Failed to connect to the database.");
        }
        
        // Query to check email in students table
        $sqlStudents = "SELECT 1 FROM students WHERE email = ?";
        $stmt = $conn->prepare($sqlStudents);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();

        // Query to check email in organisation table
        $sqlOrganisation = "SELECT 1 FROM organisations WHERE email = ?";
        $stmt = $conn->prepare($sqlOrganisation);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();

        // Query to check email in coordinators table
        $sqlCoordinators = "SELECT 1 FROM coordinators WHERE email = ?";
        $stmt = $conn->prepare($sqlCoordinators);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result->num_rows > 0;
    }

}
?>