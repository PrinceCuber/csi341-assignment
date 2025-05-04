<?php 

function getLogbook($conn) {
    $sql = "SELECT * FROM logbooks";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $logbooks[] = $row;
        }
    } else {
        $logbooks = array();
    }
    return $logbooks;
}

function getLogbookDetails($conn, $logbook_id) {
    $sql = "SELECT * FROM logbooks WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $logbook_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return array();
    }
}

function displayLogbooks($logbooks) {
    foreach($logbooks as $logbook) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($logbook['date']) . "</td>";
        echo "<td>" . htmlspecialchars($logbook['name']) . "</td>";
        echo "<td>" . htmlspecialchars($logbook['title']) . "</td>";
        echo "<td><a href='?logbook_id=" . htmlspecialchars($logbook['id']) . "'>View Details</a></td>";
        echo "</tr>";
    }
}

function displayLogbookDetails($logbook) {
    echo "<h2>Logbook Details</h2>";
    echo "<p>Date: " . htmlspecialchars($logbook['date']) . "</p>";
    echo "<p>Name: " . htmlspecialchars($logbook['name']) . "</p>";
    echo "<p>Title: " . htmlspecialchars($logbook['title']) . "</p>";
    echo "<p>Activities: " . htmlspecialchars($logbook["activities"]) . "</p>";
    echo "<p>Challenges: " . htmlspecialchars($logbook["challenges"]) . "</p>";
    echo "<p>Overview: " . htmlspecialchars($logbook["overview"]) . "</p>";
    echo "<p>Skills Acquired: " . htmlspecialchars($logbook["skills_acquired"]) . "</p>";
    echo "<p>Work Summary: " . htmlspecialchars($logbook["work_summary"]) . "</p>";

}

function numOfLogbooksUnread($conn, $student_id) {
    $sql = "SELECT COUNT(*) as count FROM logbooks WHERE student_id = ? AND status = 'unread'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc()['count'];
    } else {
        return 0;
    }
}

function markLogbookAsRead($conn, $logbook_id) {
    $sql = "UPDATE logbooks SET status = 'read' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $logbook_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>