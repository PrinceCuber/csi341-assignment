<?php
require_once __DIR__ . '/../Models/Student.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class StudentController {
    private $studentModel;

    public function __construct() {
        $this->studentModel = new Student();
    }

    // Handle creating a new student
    public function signUpStudent($name, $email, $password) {
        $studentID = $this->studentModel->createStudent($name, $email, $password);
        if ($studentID) {
            $_SESSION['student_id'] = $studentID;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: views/homeStudent.php");
            exit();
        } else {
            // Failed to create student, redirect to signup page with error message
            $errorMessage = urlencode("Failed to create student.");
            header("Location: views/signup.html?error=$errorMessage");
            exit(); 
        }
    }

    // Handle fetching a student by ID
    public function loginStudent($email, $password) {
        $user = $this->studentModel->getStudentByEmail($email);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            return true;
        } else {
            return false;
        }
    }

    // Handle updating student details
    public function updatestudent($id, $name, $email) {
        if ($this->studentModel->updateStudent($id, $name, $email)) {
            echo "student updated successfully.";
        } else {
            echo "Failed to update student.";
        }
    }

    // Handle deleting a student
    public function deletestudent($id) {
        if ($this->studentModel->deleteStudent($id)) {
            echo "student deleted successfully.";
        } else {
            echo "Failed to delete student.";
        }
    }
}
?>
