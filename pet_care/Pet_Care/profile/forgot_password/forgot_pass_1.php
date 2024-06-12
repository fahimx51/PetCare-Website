<?php
// Your database connection and other required includes
require 'config.php';
require '../../profile/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];

// Check if the email exists in the users table
$check_query = "SELECT * FROM `users` WHERE email = '$email'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0) {
    // Check if there is an existing verification code and if it's still valid
    $row = mysqli_fetch_assoc($result);
    $verificationCode = $row['verification_code'];
    $timestamp = $row['verification_timestamp'];

    // Convert Unix timestamp to a human-readable date and time format
    $humanReadableTime = date("Y-m-d H:i:s", $timestamp);

    if ($verificationCode && time() - $timestamp <= 60) { // 180 seconds = 3 minutes
        // Verification code is still valid, no need to resend
        // You can implement additional logic here if needed
        echo "<script> alert('Verification code is still valid. No need to resend.') </script>";
        echo "<script> window.location.href = 'forgot_pass_2.html'; </script>";
        exit();
    } else {
        // Generate a new verification code
        $newVerificationCode = mt_rand(100000, 999999);

        // Update the verification code and timestamp in the database
        $update_query = "UPDATE `users` SET verification_code = '$newVerificationCode', verification_timestamp = " . time() . " WHERE email = '$email'";
        if (mysqli_query($conn, $update_query)) {
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
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Verification Code';
                $mail->Body = 'Your verification code is: ' . $newVerificationCode;

                $mail->send();

                // Display success message
                echo "<script> alert('Verification code has been resent to your email.') </script>";
                echo "<script> window.location.href = 'forgot_pass_2.html'; </script>";
                exit();
            } catch (Exception $e) {
                echo "<script> alert('Email could not be sent. Error: " . $mail->ErrorInfo . "') </script>";
                echo "<script> location.href='forgot_pass.html' </script>";
                exit();
            }
        } else {
            echo "<script> alert('Error updating verification code.') </script>";
            echo "<script> location.href='forgot_pass.html' </script>";
            exit();
        }
    }
} else {
    echo "<script> alert('Email not found in the database.') </script>";
    echo "<script> location.href='forgot_pass.html' </script>";
    exit();
}
?>
