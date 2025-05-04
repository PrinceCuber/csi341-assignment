<?php 
require_once('../Config/util.php');
// Get all students who have completed attachment form

$conn = getDatabase();

function getStudents($conn) {
    $sql = "SELECT * FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    } else {
        $students = array();
    }
    return $students;
}

function getStudentDetails($conn, $student_id) {
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return array();
    }
}

function displayStudents($students) {
    foreach($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['name']) . "</td>";
        echo "<td>" . htmlspecialchars($student['email']) . "</td>";
        echo "<td>" . htmlspecialchars($student['phone']) . "</td>";
        echo "<td><a href='?student_id=" . htmlspecialchars($student['id']) . "'>View Details</a></td>";
        echo "</tr>";
    }
}

function displayStudentDetails($student) {
    echo "<h2>Student Details</h2>";
    echo "<p>Name: " . htmlspecialchars($student['name']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($student['email']) . "</p>";
    echo "<p>Phone: " . htmlspecialchars($student['phone']) . "</p>";
    // Add more fields as necessary
}

function updateStudentDetails($conn, $student_id, $name, $email ) {
    $sql = "UPDATE students SET name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $student_id);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>