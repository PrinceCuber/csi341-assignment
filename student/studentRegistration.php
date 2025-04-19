<?php
// Connection variables
$host = "localhost";
$username = "root";
$password = ""; 
$database = "studentregistration_db";

// Connect to database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if each form field is set

    if (isset($_POST['id_Num'])) {
        $omang_Or_passportNo = $_POST['id_Num'];
    }

    if (isset($_POST['phone'])) {
        $phone_number = $_POST['phone'];
    }

    if (isset($_POST['email'])) {
        $email_Address = $_POST['email'];
    }

    if (isset($_POST['dob'])) {
        $date_Of_Birth = $_POST['dob'];
    }

    if (isset($_POST['start_date'])) {
        $attachment_Start_Date = $_POST['start_date'];
    }

    if (isset($_POST['end_date'])) {
        $attachment_End_Date = $_POST['end_date'];
    }

    if (isset($_POST['location'])) {
        $preferred_Location = $_POST['location'];
    }

    if (isset($_POST['experience'])) {
        $experience = $_POST['experience'];
    }

    // Upload handling
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $doc_path = $uploadDir . basename($_FILES["upload_doc"]["name"]);

    move_uploaded_file($_FILES["upload_doc"]["tmp_name"], $doc_path);
    if(isset($_POST['doc_path'])){
        $doc_path = $_POST['upload_doc'];
    }

    if (isset($_POST['emergency_contact_name'])) {
        $emergency_Contact_Name = $_POST['emergency_contact_name'];
    }

    if (isset($_POST['emergency_contact_phone'])) {
        $emergency_Contact_Phone = $_POST['emergency_contact_phone'];
    }

    if (isset($_POST['emergency_contact_relationship'])) {
        $emergency_Contact_Relationship = $_POST['emergency_contact_relationship'];
    }

    // Insert into database
    $sql = "INSERT INTO studentsTable2 (
        omang_Or_passportNo, phone_number, email_Address, date_Of_Birth,
        attachment_Start_Date, attachment_End_Date, preferred_Location, experience,
        doc_path, emergency_Contact_Name, emergency_Contact_Phone, emergency_Contact_Relationship
    ) VALUES (
        '$omang_Or_passportNo', '$phone_number', '$email_Address', '$date_Of_Birth',
        '$attachment_Start_Date', '$attachment_End_Date', '$preferred_Location', '$experience',
        '$doc_path', '$emergency_Contact_Name', '$emergency_Contact_Phone', '$emergency_Contact_Relationship'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "✅ Student registered successfully!";
    } else {
        echo " Error: " . $conn->error;
    }

    $conn->close();
}
?>

