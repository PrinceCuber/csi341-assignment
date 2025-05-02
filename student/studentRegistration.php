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

    if (isset($_POST['doc_path'])) {
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
    $stmt->bind_param(
        "ssssssssssss",
        $omang_Or_passportNo,
        $phone_number,
        $email_Address,
        $date_Of_Birth,
        $attachment_Start_Date,
        $attachment_End_Date,
        $preferred_Location,
        $experience,
        $doc_path,
        $emergency_Contact_Name,
        $emergency_Contact_Phone,
        $emergency_Contact_Relationship
    );
    if ($stmt->execute()) {
        header("Location: dashboard.php?success=Registration successful.");
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="../public/css/studentRegistration.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Student Registration</h1>
        </header>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_Num">Omang/Passport No:</label>
                <input type="text" id="id_Num" name="id_Num" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="start_date">Attachment Start Date:</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">Attachment End Date:</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="location">Preferred Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="experience">Experience:</label>
                <textarea id="experience" name="experience" required></textarea>
            </div>
            <div class="form-group">
                <label for="upload_doc">Upload Document:</label>
                <input type="file" id="upload_doc" name="upload_doc" required>
            </div>
            <div class="form-group">
                <label for="emergency_contact_name">Emergency Contact Name:</label>
                <input type="text" id="emergency_contact_name" name="emergency_contact_name" required>
            </div>
            <div class="form-group">
                <label for="emergency_contact_phone">Emergency Contact Phone:</label>
                <input type="text" id="emergency_contact_phone" name="emergency_contact_phone" required>
            </div>
            <div class="form-group">
                <label for="emergency_contact_relationship">Emergency Contact Relationship:</label>
                <input type="text" id="emergency_contact_relationship" name="emergency_contact_relationship" required>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>