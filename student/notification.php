<?php
require_once('../Config/util.php');
// Start the session to store notifications
session_start();

$conn = getDatabase();

/**
 * Set a notification message in the database
 */
function setNotification($id_num, $user_type, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifications (id_num, user_type, message ) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $id_num, $user_type, $message);
    $stmt->execute();
    $stmt->close();
}

/**
 * Display and clear the notification message from the database
 */
function displayNotifications($conn, $id_num, $user_type) {

    $stmt = $conn->prepare("SELECT id, message FROM notifications WHERE id_num = ? AND user_type = ?");
    $stmt->bind_param("ss", $id_num, $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='notification'>" . htmlspecialchars($row['message']) . "</div>";
        }
        // Set notifications to read after displaying them
        $sql = "UPDATE notifications SET status = read WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "<div class='notification'>No new notifications.</div>";
    }
}

function clearNotifications($conn, $id_num, $user_type) {
    $stmt = $conn->prepare("DELETE FROM notifications WHERE id_num = ? AND user_type = ?");
    $stmt->bind_param("ss", $id_num, $user_type);
    $stmt->execute();
    $stmt->close();
}

?>