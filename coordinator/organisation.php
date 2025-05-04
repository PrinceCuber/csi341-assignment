<?php 

function getOrganisations($conn) {
    $sql = "SELECT * FROM organisations";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $organisations[] = $row;
        }
    } else {
        $organisations = array();
    }
    return $organisations;
}

function getOrganisationDetails($conn, $organisation_id) {
    $sql = "SELECT * FROM organisations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $organisation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return array();
    }
}

function displayOrganisations($organisations) {
    foreach($organisations as $organisation) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($organisation['name']) . "</td>";
        echo "<td>" . htmlspecialchars($organisation['email']) . "</td>";
        echo "<td>" . htmlspecialchars($organisation['phone']) . "</td>";
        echo "<td><a href='?organisation_id=" . htmlspecialchars($organisation['id']) . "'>View Details</a></td>";
        echo "</tr>";
    }
}

function displayOrganisationDetails($organisation) {
    echo "<h2>Organisation Details</h2>";
    echo "<p>Name: " . htmlspecialchars($organisation['contact_name']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($organisation['contact_email']) . "</p>";
    echo "<p>Slot: " . htmlspecialchars($organisation['slot']) . "</p>";
    echo "<p>Skills: " . htmlspecialchars($organisation['skills']) . "</p>";
}

function numOfOrganisationsBetween($conn, $start_date, $end_date) {
    $sql = "SELECT COUNT(*) as count FROM organisations WHERE created_at BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc()['count'];
    } else {
        return 0;
    }
}
?>