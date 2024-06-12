<?php
require 'config.php';
require '../profile/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_pass = $_POST['confirm_pass'];
$address = $_POST['address'];

// Check if the email already exists in the database
$check_query = "SELECT * FROM `users` WHERE email = '$email'";
$duplicate_user = mysqli_query($conn, $check_query);

// If the email is already in use, notify the user
if (mysqli_num_rows($duplicate_user) > 0) {
    echo "<script> alert('Email address is already in use. Please use a different email.') </script>";
    echo "<script> location.href='index.html' </script>";
    exit();
}

// Generate a random verification code
$verificationCode = md5(uniqid(rand(), true));

// File upload handling
$targetDirectory = "pic/";
$profileImage = $_FILES['profileImage']['name'];
$targetFilePath = $targetDirectory . basename($profileImage);
$imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

// Check if image file is a valid image
$check = getimagesize($_FILES["profileImage"]["tmp_name"]);
if ($check === false) {
    echo "<script> alert('Invalid image file.') </script>";
    echo "<script> location.href='index.html' </script>";
    exit();
}

// Check file size (10MB)
$maxFileSize = 10 * 1024 * 1024;//byte
if ($_FILES["profileImage"]["size"] > $maxFileSize) {
    echo "<script> alert('File is too large. Maximum allowed size is 10 MB.') </script>";
    echo "<script> location.href='index.html' </script>";
    exit();
}

// Allow certain file formats
$allowedFormats = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedFormats)) {
    echo "<script> alert('Only JPG, JPEG, PNG, and GIF files are allowed.') </script>";
    echo "<script> location.href='index.html' </script>";
    exit();
}

// Move uploaded file to target directory
if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFilePath)) {
    $temp_insert_query = "INSERT INTO `temp_users`(`name`, `email`, `password`, `confirm_pass`, `address`, `profile_picture`, `verification_code`) 
    VALUES ('$name', '$email', '$password', '$confirm_pass', '$address', '$targetFilePath', '$verificationCode')";

    if (strlen($name) < 3 || strlen($name) > 20) {
        echo "<script> alert('Username length 3-20') </script>";
        echo "<script> location.href='index.html' </script>";
    } elseif ($password != $confirm_pass) {
        echo "<script> alert('Password do not match!') </script>";
        echo "<script> location.href='index.html' </script>";
    } elseif (!mysqli_query($conn, $temp_insert_query)) {
        echo "<script> alert('Not Inserted!') </script>";
        echo "<script> location.href='index.html' </script>";
    } else {
        // Send verification email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mdabulkhair2001@gmail.com'; 
            $mail->Password = 'jaat jbpd tiwz saod';      // App password obtained from Gmail
            $mail->Port = 465;                  
            $mail->SMTPSecure = 'ssl'; 

            //Recipients
            $mail->setFrom('mdabulkhair2001@gmail.com', 'Admin');
            $mail->addAddress($email, $name);

// Content
$mail->isHTML(true);
$mail->Subject = 'Verify Your Email Address for Pet Care Website';

$verificationLink = "http://localhost/pet_care/Pet_Care/profile/verify.php?code=$verificationCode";

// Email body with inline CSS for styling
$mail->Body = "
    <html>
    <head>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #007BFF;
            }
            p {
                line-height: 1.6;
            }
            a {
                color: #007BFF;
                text-decoration: none;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Verify Your Email Address</h2>
            <p>Dear Sir,</p>
            <p>Thank you for registering with Pet-Care. We're excited to have you as part of our community dedicated to the well-being of our furry friends.</p>
            <p>To ensure the security of your account and provide you with the best experience, we kindly ask you to verify your email address. Please follow the simple steps below:</p>
            <ol>
            <li>Click on the following link to verify your email address: <a href='$verificationLink'>Verify Email</a></li>
            <li>If the link doesn't work, copy and paste the following URL into your browser: $verificationLink</li>
            </ol>
            <p>If you did not register for an account on Pet-Care, please disregard this email. Your account will only be activated upon verification.</p>
            <p>Best regards,<br>

           Admin<br>
            Pet-Care<br>
            Contact: +880 1********9</p>
        </div>
    </body>
    </html>
";

            $mail->send();

            // Display success message
            echo "<script> location.href='email.php' </script>";
            exit();
        } catch (Exception $e) {
            echo "<script> alert('Email could not be sent. Error: " . $mail->ErrorInfo . "') </script>";
            echo "<script> location.href='index.html' </script>";
            exit();
        }
    }
} else {
    echo "<script> alert('Error uploading image.') </script>";
    echo "<script> location.href='index.html' </script>";
    exit();
}
?>