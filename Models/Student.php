<?php

require_once __DIR__ . '/../config/db.php';

class Student {
    // Method to create a new student
    public static function createStudent($name, $email, $password) {
        $conn = getDatabase();
        $conn->query("
            CREATE TABLE IF NOT EXISTS students (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) UNIQUE,
            email VARCHAR(255),
            password TEXT
        );
        ");
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

    // Method to get student by ID
    public static function getStudentById($id) {
        $conn = getDatabase();
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
}
?>