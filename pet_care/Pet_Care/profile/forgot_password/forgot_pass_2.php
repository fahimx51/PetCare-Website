<?php
require 'config.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $digit1 = $_POST['digit1'];
    $digit2 = $_POST['digit2'];
    $digit3 = $_POST['digit3'];
    $digit4 = $_POST['digit4'];
    $digit5 = $_POST['digit5'];
    $digit6 = $_POST['digit6'];
    
    $code = $digit1 . $digit2 . $digit3 . $digit4 . $digit5 . $digit6; // Concatenate the digits to form the code

    // Check if the verification code exists in the users table
    $check_query = "SELECT * FROM `users` WHERE verification_code = '$code'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Verification code matched, proceed with password reset
        // Retrieve the user's email from the database
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Check if the code has expired (assuming 3 minutes expiration)
        $code_time = $row['verification_timestamp'];
        $current_time = time();
        $code_validity_duration = 1 * 60; // 3 minutes in seconds

        if (($current_time - $code_time) > $code_validity_duration) {
            // Code has expired
            echo "<script>alert('The verification code has expired. Please request a new one.')</script>";
            echo "<script>window.location.href = 'forgot_pass_2.html';</script>";
            exit();
        }

        // Set the email in session
        $_SESSION['email'] = $email;

        // Redirect to the update password page
        header("Location: forgot_pass_3.html");
        exit();
    } else {
        // Verification code doesn't match
        echo "<script>alert('Invalid verification code. Please try again.')</script>";
        echo "<script>window.location.href = 'forgot_pass_2.html';</script>";
        exit();
    }
} else {
    // If accessed directly, redirect to the verification code entry page
    header("Location: forgot_pass_2.html");
    exit();
}
?>
