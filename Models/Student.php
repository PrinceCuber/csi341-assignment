<?php

require_once __DIR__ . '/../config/db.php';

class Student {
    // Method to create a new student
    public static function createStudent($name, $email, $password) {
        $conn = getDatabase();
        // Check if the table exists, if not create it
        self::createStudentTable($conn);
        $sql = "INSERT INTO students (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param('sss', $name, $email, $hashedPassword);
        $success = $stmt->execute();
        $insertedId = $success ? $conn->insert_id : null;
        $stmt->close();
        $conn->close();
        return $insertedId; 
    }

    // Method to get student by Email
    public static function getStudentByEmail($email) {
        $conn = getDatabase();
        self::createStudentTable($conn);
        $sql = "SELECT user_id, name, email, password FROM students WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $student;
    }

    // Method to update student information
    public static function updateStudent($id, $name, $email) {
        $conn = getDatabase();
        $sql = "UPDATE students SET name = ?, email = ?WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $name, $email, $id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    // Method to delete a student
    public function deleteStudent($id) {
        $conn = getDatabase();
        $sql = "DELETE FROM students WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    // Method to create a new student table if it doesn't exist
    private static function createStudentTable($conn) {
        $sql = "CREATE TABLE IF NOT EXISTS students (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $conn->query($sql);
    }
}
?>