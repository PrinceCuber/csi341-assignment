<?php
require_once __DIR__ . '/../Models/Organisation.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class OrganisationController {
    private $organisationModel;

    public function __construct() {
        $this->organisationModel = new Organisation();
    }

    // Handle creating a new organisation
    public function signUpOrganisation($name, $email, $password, $location, $techPreferences) {
        $organisationID = $this->organisationModel->createOrganisation($name, $email, $location, $techPreferences, $password);
        if ($organisationID) {
            $_SESSION['organisation_id'] = $organisationID;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: views/dashboardOrganisation.php");
            exit();
        } else {
            // Failed to create organisation, redirect to signup page with error message
            $errorMessage = urlencode("Failed to create organisation.");
            header("Location: views/signup.html?error=$errorMessage");
            exit(); 
        }
    }

    // Handle fetching an organisation by ID
    public function loginOrganisation($email, $password) {
        $user = $this->organisationModel->getOrganisationByEmail($email);

        if (!$user) {
            return false;
        }
        if (password_verify($password, $user['password'])) {
            $_SESSION['organisation_id'] = $user['organisation_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            return true;
        } else {
            return false;
        }
    }

    // Handle updating organisation details
    public function updateOrganisation($id, $name, $email, $location, $techPreferences) {
        if ($this->organisationModel->updateOrganisation($id, $name, $email, $location, $techPreferences)) {
            echo "Organisation updated successfully.";
        } else {
            echo "Failed to update organisation.";
        }
    }

    // Handle deleting an organisation
    public function deleteOrganisation($id) {
        if ($this->organisationModel->deleteOrganisation($id)) {
            echo "Organisation deleted successfully.";
        } else {
            echo "Failed to delete organisation.";
        }
    }
}
?>
