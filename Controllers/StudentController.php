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

    // Handle creating a new user
    public function signUpStudent($name, $email, $password) {
        $studentID = $this->studentModel->createStudent($name, $email, $password);
        if ($studentID) {
            $_SESSION['user_id'] = $studentID;
            $_SESSION['username'] = $name;
            $_SESSION['email'] = $email;
            header("Location: Views/home.php");
            exit();
        } else {
            // Failed to create user, redirect to signup page with error message
            $errorMessage = urlencode("Failed to create user.");
            header("Location: Views/student-signup.html?error=$errorMessage");
            exit(); 
        }
    }

    // Handle fetching a user by ID
    public function loginStudent($email, $password) {
        $user = $this->studentModel->getStudentByEmail($email);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            header("Location: Views/dashboard.php");
            exit();
        } else {
            // Invalid credentials, redirect to login page with error message
            $errorMessage = urlencode("Invalid email or password.");
            header("Location: Views/student-login.html?error=$errorMessage");
            exit();
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
