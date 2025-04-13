<?php
// routing.php
// This file handles routing for the application and includes the necessary controllers and models.
// It processes requests based on the action specified in the query string.

// TODO: validate data
require_once 'Controllers/StudentController.php';
require_once 'Controllers/CoordinatorController.php';
require_once 'Controllers/OrganisationController.php';

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the action from the query string
$action = $_GET['action'] ?? null;

// Create an instance of the controller
$studentController = new StudentController();
$coordinatorController = new CoordinatorController();
$organisationController = new OrganisationController();

switch ($action) {
    case 'signup':
        // Handle user creation
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($_POST['role'] == 'organisation') {
                $location = $_POST['location'];
                $techPreferences = $_POST['tech_preferences'];
            }

            if($_POST['role'] == 'student'){
                $studentController->signUpStudent($name, $email, $password);
            } else if($_POST['role'] == 'coordinator'){
                $coordinatorController->signUpCoordinator($name, $email, $password);
            } else if ($_POST['role'] == 'organisation') {
                $organisationController->signUpOrganisation($name, $email, $password, $location, $techPreferences);
            } else if($_POST['role'] == 'admin'){
                die("Admin role is not supported yet.");
            } else { 
                // Invalid role, redirect to signup page with error message
                $errorMessage = urlencode("Something went wrong.");
                header("Location: views/signup.html?error=$errorMessage");
                exit(); 
            }
        }
        break;

    case 'login':
        // Handle fetching a user by Email
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($studentController->loginStudent($email, $password)) {
                header("Location: views/homeStudent.php");
                exit();
            } else if($coordinatorController->loginCoordinator($email, $password)){
                header("Location: views/dashboardCoordinator.php");
                exit();
            } else if($organisationController->loginOrganisation($email, $password)){
                header("Location: views/dashboardOrganisation.php");
                exit();
            } else {
                // Invalid credentials, redirect to login page with error message
                $errorMessage = urlencode("Invalid email or password.");
                header("Location: views/login.html?error=$errorMessage");
                exit(); 
            }
        }
        break;

    case 'update':
        // Handle updating a student
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $studentController->updatestudent($id, $name, $email);
        }
        break;

    case 'delete':
        // Handle deleting a student
        $id = $_GET['id'] ?? null;
        if ($id) {
            $studentController->deletestudent($id);
        }
        break;

    default:
        // Default action (e.g., show a 404 page or redirect)
        echo "Invalid action.";
        break;
}

// This function is used to validate the data received from the form inputs.
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
}
