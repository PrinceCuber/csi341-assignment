<?php
require_once __DIR__ . '/../Models/Student.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class UserController {
    private $studentModel;

    public function __construct() {
        $this->studentModel = new Student();
    }

    // Handle creating a new user
    public function createStudent($name, $email, $password) {
        $studentID = $this->studentModel->createStudent($name, $email, $password);
        if ($studentID) {
            $_SESSION['user_id'] = $studentID;
            $_SESSION['username'] = $name;
            $_SESSION['email'] = $email;
            header("Location: Views/home.php");
            exit();
        } else {
            $errorMessage = urlencode("Failed to create user.");
            header("Location: Views/student-signup.html?error=$errorMessage");
            exit(); 
        }
    }

    // Handle fetching a user by ID
    public function getStudent($id) {
        $user = $this->studentModel->getStudentById($id);
        if ($user) {
            echo "User Details: " . json_encode($user);
        } else {
            echo "User not found.";
        }
    }

    // Handle updating user details
    public function updateUser($id, $name, $email) {
        if ($this->studentModel->updateStudent($id, $name, $email)) {
            echo "User updated successfully.";
        } else {
            echo "Failed to update user.";
        }
    }

    // Handle deleting a user
    public function deleteUser($id) {
        if ($this->studentModel->deleteStudent($id)) {
            echo "User deleted successfully.";
        } else {
            echo "Failed to delete user.";
        }
    }
}
?>
