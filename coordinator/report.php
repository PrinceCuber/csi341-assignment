<?php 

function getReport($conn) {
    $sql = "SELECT * FROM reports";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $reports[] = $row;
        }
    } else {
        $reports = array();
    }
    return $reports;
}

function getReportDetails($conn, $report_id) {
    $sql = "SELECT * FROM reports WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return array();
    }
}

function displayReports($reports) {
    foreach($reports as $report) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($report['title']) . "</td>";
        echo "<td>" . htmlspecialchars($report['description']) . "</td>";
        echo "<td><a href='?report_id=" . htmlspecialchars($report['id']) . "'>View Details</a></td>";
        echo "</tr>";
    }
}

function displayReportDetails($report) {
    echo "<h2>Report Details</h2>";
    echo "<p>Title: " . htmlspecialchars($report['title']) . "</p>";
    echo "<p>Description: " . htmlspecialchars($report['description']) . "</p>";
    echo "<p>Student Name: " . htmlspecialchars($report['student_name']) . "</p>";
    echo "<p>Organization: " . htmlspecialchars($report['organization']) . "</p>";
    echo "<p>Duration: " . htmlspecialchars($report['duration']) . "</p>";
    echo "<p>Overview: " . htmlspecialchars($report['overview']) . "</p>";
    echo "<p>Skills Acquired: " . htmlspecialchars($report['skills_acquired']) . "</p>";
    echo "<p>Challenges: " . htmlspecialchars($report['challenges']) . "</p>";
    echo "<p>Future Goals: " . htmlspecialchars($report['future_goals']) . "</p>";
}

function numOfReportsUnread($conn, $student_id) {
    $sql = "SELECT COUNT(*) as count FROM reports WHERE student_id = ? AND status = 'unread'";
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

function markReportAsRead($conn, $report_id) {
    $sql = "UPDATE reports SET status = 'read' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $report_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

?>