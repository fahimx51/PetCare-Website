<?php
// Your database connection and other required includes
require 'config.php';
require '../../profile/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start(); // Start the session

$email = $_SESSION['email']; // Assuming you have stored the email in session

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

        // Return success message
        echo "Verification code has been resent to your email.";
    } catch (Exception $e) {
        // Return error message if email could not be sent
        echo "Email could not be sent. Error: " . $mail->ErrorInfo;
    }
} else {
    // Return error message if updating verification code failed
    echo "Error updating verification code.";
}
?>
