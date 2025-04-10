<?php
require_once 'Controllers/StudentController.php';

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the action from the query string
$action = $_GET['action'] ?? null;

// Create an instance of the controller
$studentController = new UserController();

switch ($action) {
    case 'createStudent':
        // Handle student creation
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $studentController->createStudent($name, $email, $password);
        }
        break;

    case 'getStudent':
        // Handle fetching a student by ID
        $id = $_GET['id'] ?? null;
        if ($id) {
            $studentController->getStudent($id);
        }
        break;

    case 'updateStudent':
        // Handle updating a student
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $studentController->updateUser($id, $name, $email);
        }
        break;

    case 'deleteStudent':
        // Handle deleting a student
        $id = $_GET['id'] ?? null;
        if ($id) {
            $studentController->deleteUser($id);
        }
        break;

    default:
        // Default action (e.g., show a 404 page or redirect)
        echo "Invalid action.";
        break;
}
?>