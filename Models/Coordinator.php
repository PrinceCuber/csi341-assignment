
<?php

require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../helpers/util.php';

class Coordinator {
    // Method to create a new coordinate
    public static function createCoordinator($name, $email, $password) {
        $conn = getDatabase();
        //check if the connection is successful
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

        $sql = "INSERT INTO coordinators (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param('sss', $name, $email, $hashedPassword);
        $success = $stmt->execute();
        $insertedId = $success ? $conn->insert_id : null;
        $stmt->close();
        $conn->close();
        return $insertedId; 
    }

    // Method to get coordinator by Email
    public static function getCoordinatorByEmail($email) {
        $conn = getDatabase();
        $sql = "SELECT coordinator_id, name, email FROM coordinators WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $coordinator = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $coordinator;
    }

    // Method to update coordinator information
    public static function updateCoordinator($id, $name, $email) {
        $conn = getDatabase();
        $sql = "UPDATE coordinators SET name = ?, email = ?WHERE coordinator_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $name, $email, $id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }

    // Method to delete a coordinator
    public function deleteCoordinator($id) {
        $conn = getDatabase();
        $sql = "DELETE FROM coordinators WHERE coordinator_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $success = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $success;
    }
}
?>