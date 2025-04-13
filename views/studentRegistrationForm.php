<?php
session_start();

if (!isset($_SESSION['student_id'])) {
  header("Location: login.html");
  exit();
}

$user_id = $_SESSION['student_id'];
$username = $_SESSION['name'];
$email = $_SESSION['email'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attachment Registration Form</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f8;
            margin: 0;
            padding: 20px;
        }

        fieldset {
            max-width: 700px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        legend {
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        textarea {
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            margin-top: 25px;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <fieldset>
        <legend style="text-align: center; font-weight: bold; font-size: 35px;">Student Attachment Registration Form</legend>
        <form action="/routing.php?action=attachment" method="POST" enctype="multipart/form-data">
       
        <label for="id_Num">Omang/Passport Number:</label>
        <input type="text" id="id_Num" name="id_Num" placeholder="e.g. 123456789"  required><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="e.g. +267 71223344" required><br>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>
        
        <label for="start_date">Attachment Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br>

        <label for="end_date">Attachment End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br>
        
        <label for="location">Preferred Location/Region:</label>
        <input type="text" id="location" name="location" placeholder="e.g. Maun" required><br>
 
        <label for="experience">Skills(if any):</label><br>
        <input type="text" id="skills" name="skills" placeholder="Skills..." ></input><br>

        <label for="cv_upload">Upload Documents(Transcript, CV, Letter Of Organisation & CoverLetter in Zip format):</label>
        <input type="file" id="upload_doc" name="upload_doc" accept=".zip" required><br>

        <label for="emergency_contact_name">Emergency Contact Name:</label>
        <input type="text" id="emergency_contact_name" name="emergency_contact_name" required><br>

        <label for="emergency_contact_phone">Emergency Contact Phone Number:</label>
        <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" placeholder="e.g. +267 71223344" required><br>

        <label for="emergency_contact_relationship">Emergency Contact Relationship:</label>
        <input type="text" id="emergency_contact_relationship" name="emergency_contact_relationship" placeholder="e.g. Mother etc" required><br>

        <input type="submit" value="Submit Registration">
    </form>
</fieldset>
</body>

</html>
