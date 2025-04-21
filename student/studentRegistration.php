<?php
include_once '../Config/util.php';
include_once '../Config/helper.php';
// Connect to database
$conn = getDatabase();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if each form field is set

    if (isset($_POST['id_Num'])) {
        $omang_Or_passportNo = test_input($_POST['id_Num']);
    }

    if (isset($_POST['phone'])) {
        $phone_number = test_input($_POST['phone']);
    }

    if (isset($_POST['email'])) {
        $email_Address = test_input($_POST['email']);
    }

    if (isset($_POST['dob'])) {
        $date_Of_Birth = test_input($_POST['dob']);
    }

    if (isset($_POST['start_date'])) {
        $attachment_Start_Date = test_input($_POST['start_date']);
    }

    if (isset($_POST['end_date'])) {
        $attachment_End_Date = test_input($_POST['end_date']);
    }

    if (isset($_POST['location'])) {
        $preferred_Location = test_input($_POST['location']);
    }

    if (isset($_POST['experience'])) {
        $experience = test_input($_POST['experience']);
    }

    // Upload handling
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $doc_path = $uploadDir . basename($_FILES["upload_doc"]["name"]);

    move_uploaded_file($_FILES["upload_doc"]["tmp_name"], $doc_path);

    if(isset($_POST['doc_path'])){
        $doc_path = test_input($_POST['upload_doc']);
    }

    if (isset($_POST['emergency_contact_name'])) {
        $emergency_Contact_Name = test_input($_POST['emergency_contact_name']);
    }

    if (isset($_POST['emergency_contact_phone'])) {
        $emergency_Contact_Phone = test_input($_POST['emergency_contact_phone']);
    }

    if (isset($_POST['emergency_contact_relationship'])) {
        $emergency_Contact_Relationship = test_input($_POST['emergency_contact_relationship']);
    }

    // Insert into database
    $sql = "INSERT INTO studentsTable2 (
        omang_Or_passportNo, phone_number, email_Address, date_Of_Birth,
        attachment_Start_Date, attachment_End_Date, preferred_Location, experience,
        doc_path, emergency_Contact_Name, emergency_Contact_Phone, emergency_Contact_Relationship
    ) VALUES (
        '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?'
    )";

    $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $omang_Or_passportNo, $phone_number, $email_Address, $date_Of_Birth,
        $attachment_Start_Date, $attachment_End_Date, $preferred_Location, $experience,
        $doc_path, $emergency_Contact_Name, $emergency_Contact_Phone, $emergency_Contact_Relationship
    );
    if ($stmt->execute()) {
        header("Location: student/dashboard.php?success=Registration successful.");
        exit();
    } else {
        // TODO: replace with a more user-friendly error message
        // Decide where to redirect the user in case of an error
        // You can redirect to a different page or show an error message on the same page
        header("Location: studentRegistration.php?error=Error: " . $stmt->error);
        exit();
    }

    $conn->close();
}
?>

