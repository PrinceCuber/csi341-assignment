<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitize($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $org_name = sanitize($_POST['org_name']);
    $industry_type = sanitize($_POST['industry_type']);
    $location = sanitize($_POST['location']);
    $contact_person = sanitize($_POST['contact_person']);
    $contact_email = sanitize($_POST['contact_email']);
    $contact_phone = sanitize($_POST['contact_phone']);
    $tech_skills = sanitize($_POST['tech_skills']);
    $slots = intval($_POST['slots']);
    $projects = sanitize($_POST['projects']);

    $errors = [];

    if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match("/^\+267\s?\d{7,8}$/", $contact_phone)) {
        $errors[] = "Phone number must start with +267 and contain 8 digits.";
    }

    if ($slots < 1) {
        $errors[] = "At least one slot must be offered.";
    }

    if ($_FILES['requirements_doc']['error'] === 0) {
        $allowed_types = ['application/pdf'];
        if (!in_array($_FILES['requirements_doc']['type'], $allowed_types)) {
            $errors[] = "Uploaded file must be a PDF.";
        }
    }

    if (empty($errors)) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_path = $upload_dir . basename($_FILES["requirements_doc"]["name"]);
        $upload_success = move_uploaded_file($_FILES["requirements_doc"]["tmp_name"], $file_path);


$subject = "Organization Registration Confirmation";
$message = "Dear $contact_person,\n\nThank you for registering your organization \"$org_name\" for student attachment.\n\nDetails Received:\nIndustry: $industry_type\nLocation: $location\nSlots Available: $slots\n\nWe appreciate your participation.\n\nRegards,\nUniversity Attachments Office";
$headers = "From: attachments@university.ac.bw\r\nReply-To: no-reply@university.ac.bw";

mail($contact_email, $subject, $message, $headers);


        echo "<link rel='stylesheet' href='org.css'>";
        echo "<div class='success'>";
        echo "<h2>Registration Successful!</h2>";
        echo "<p><strong>Organization:</strong> $org_name</p>";
        echo "<p><strong>Email:</strong> $contact_email</p>";
        echo "<p><strong>Phone:</strong> $contact_phone</p>";
        echo "<p><strong>Slots:</strong> $slots</p>";
        echo $upload_success ? "<p>File uploaded successfully.</p>" : "<p>File upload failed.</p>";
        echo "<a href='organizationRegistration.php'>Register Another</a>";
        echo "</div>";
        exit();
    } else {
        echo "<link rel='stylesheet' href='org.css'>";
        echo "<div class='error'><h3>Submission Errors:</h3><ul>";
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul><a href='javascript:history.back()'>Go Back</a></div>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organization Registration</title>
    <link rel="stylesheet" href="org.css">
    <script>
        function validateForm() {
            const email = document.getElementById("contact_email").value;
            const phone = document.getElementById("contact_phone").value;
            const slots = document.getElementById("slots").value;

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phonePattern = /^\+267\s?\d{7,8}$/;

            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (!phonePattern.test(phone)) {
                alert("Phone number must start with +267 and contain 7 or 8 digits.");
                return false;
            }

            if (parseInt(slots) < 1) {
                alert("Number of students must be at least 1.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <fieldset>
        <legend>Organization Registration Form</legend>
        <form action="organizationRegistration.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">

            <label for="org_name">Organization Name:</label>
            <input type="text" id="org_name" name="org_name" required>

            <label for="industry_type">Industry Type:</label>
            <input type="text" id="industry_type" name="industry_type" required>

            <label for="location">Location/Region:</label>
            <input type="text" id="location" name="location" required>

            <label for="contact_person">Contact Person Name:</label>
            <input type="text" id="contact_person" name="contact_person" required>

            <label for="contact_email">Contact Email:</label>
            <input type="email" id="contact_email" name="contact_email" required>

            <label for="contact_phone">Contact Phone Number:</label>
            <input type="tel" id="contact_phone" name="contact_phone" required>

            <label for="tech_skills">Preferred Student Skills/Technologies:</label>
            <input type="text" id="tech_skills" name="tech_skills" required>

            <label for="slots">Number of Students You Can Host:</label>
            <input type="number" id="slots" name="slots" min="1" required>

            <label for="projects">Project Areas Available:</label>
            <textarea id="projects" name="projects" rows="4" cols="50"></textarea>

            <label for="requirements_doc">Upload Requirements Document (PDF only):</label>
            <input type="file" id="requirements_doc" name="requirements_doc" accept=".pdf"><br>

            <input type="submit" value="Register Organization">
        </form>
    </fieldset>
</body>
</html>
