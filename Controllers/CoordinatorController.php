<?php
require_once __DIR__ . '/../Models/Organisation.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class CoordinatorController {
    private $coordinatorModel;

    public function __construct() {
        $this->coordinatorModel = new Coordinator();
    }

    // Handle creating a new coordinator
    public function signUpCoordinator($name, $email, $password) {
        $studentID = $this->coordinatorModel->createCoordinator($name, $email, $password);
        if ($studentID) {
            $_SESSION['coordinator_id'] = $studentID;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: views/dashboardCoordinator.php");
            exit();
        } else {
            // Failed to create coordinator, redirect to signup page with error message
            $errorMessage = urlencode("Failed to create coordinator.");
            header("Location: views/signup.html?error=$errorMessage");
            exit(); 
        }
    }

    // Handle fetching a coordinator by ID
    public function loginCoordinator($email, $password) {
        $user = $this->coordinatorModel->getCoordinatorByEmail($email);

        if (!$user) {
            return false;
        }
        if (password_verify($password, $user['password'])) {
            $_SESSION['coordinator_id'] = $user['coordinator_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            return true;
        } else {
            return false;
        }
    }

    // Handle updating coordinator details
    public function updatecoordinator($id, $name, $email) {
        if ($this->coordinatorModel->updateCoordinator($id, $name, $email)) {
            echo "coordinator updated successfully.";
        } else {
            echo "Failed to update coordinator.";
        }
    }

    // Handle deleting a coordinator
    public function deletecoordinator($id) {
        if ($this->coordinatorModel->deleteCoordinator($id)) {
            echo "coordinator deleted successfully.";
        } else {
            echo "Failed to delete coordinator.";
        }
    }
}
?>
