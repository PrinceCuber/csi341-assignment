<?php

require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../helpers/util.php';

class Student {
    // Method to create a new student
    public static function createStudent($name, $email, $password) {
        $conn = getDatabase();

        // Check if the connection is successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the email already exists
        if (Util::emailExists($email)) {
            // Email does exist, redirect to signup page with error message
            $errorMessage = urlencode("Email already exists.");
            header("Location: ../views/signup.html?error=$errorMessage");
            exit();
        }

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
        $sql = "SELECT student_id, name, email, password FROM students WHERE email = ?";
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

    public function createAttachment($studentID, $id_num, $phone_number, $dob, $attachment_Start_Date, $attachment_End_Date, $preferred_Location, $experience, $doc_path, $emergency_Contact_Name, $emergency_Contact_Phone, $emergency_Contact_Relationship) {
        $conn = getDatabase();
        $sql = "INSERT INTO attachments (student_id, id_num, phone_number, dob, attachment_start_date, attachment_end_date, location, experience, doc_path, emergency_contact_name, emergency_contact_phone, emergency_contact_relationship) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isssssssssss', $studentID, $id_num, $phone_number, $dob, $attachment_Start_Date, $attachment_End_Date, $preferred_Location, $experience, $doc_path, $emergency_Contact_Name, $emergency_Contact_Phone, $emergency_Contact_Relationship);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    // Method to get all students
    public static function getAllStudents() {
        $conn = getDatabase();
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        $students = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }
        $conn->close();
        return $students;
    }
}
?>