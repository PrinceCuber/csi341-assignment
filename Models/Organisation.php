<?php

require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../helpers/util.php';

class Organisation {
    // Method to create a new organisation
    public static function createOrganisation($name, $email, $password) {
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

        $sql = "INSERT INTO organisations (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param('sss', $name, $email, $hashedPassword);
        $success = $stmt->execute();
        $insertedId = $success ? $conn->insert_id : null;
        $stmt->close();
        $conn->close();
        return $insertedId; 
    }

    // Method to get organisation by Email
    public static function getOrganisationByEmail($email) {
        $conn = getDatabase();
        $sql = "SELECT organisation_id, name, email, password FROM organisations WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $organisation = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $organisation;
    }

    // Method to update organisation information
    public static function updateOrganisation($id, $name, $email, $location, $techPreferences) {
        $conn = getDatabase();
        $sql = "UPDATE organisations SET name = ?, email = ?, location = ?, tech_preferences = ? WHERE organisation_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $name, $email, $location, $techPreferences, $id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    // Method to delete an organisation
    public static function deleteOrganisation($id) {
        $conn = getDatabase();
        $sql = "DELETE FROM organisations WHERE organisation_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    // Method to get all organisations
    public static function getAllOrganisations() {
        $conn = getDatabase();
        $sql = "SELECT organisation_id, name, email FROM organisations";
        $result = $conn->query($sql);
        $organisations = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $organisations[] = $row;
            }
        }
        $conn->close();
        return $organisations;
    }

    // Method to create an organisation registration
    public static function createOrganisationRegistration($organisationID, $contact_person, $contact_email, $slots, $skills) {
        $conn = getDatabase();
        $sql = "INSERT INTO organisation_registration (organisation_id, contact_person, contact_email, slots, skills) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issss', $organisationID, $contact_person, $contact_email, $slots, $skills);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }
}
?>