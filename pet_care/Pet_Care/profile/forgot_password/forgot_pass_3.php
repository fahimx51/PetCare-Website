<?php
require 'config.php';
session_start(); // Start the session

// Check if the email is set in the session
if (!isset($_SESSION['email'])) {
    echo "Session variable 'email' not set.";
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $old_password = $_POST['password'];

    // Check if old password and new password are the same
    if ($new_password === $old_password) {
        echo "<script>alert('Old password and new password cannot be the same. Please choose a different password.')</script>";
        echo "<script>window.location.href = 'forgot_pass_3.html';</script>"; // Redirect to update password page
        exit();
    }

    // Update the password in the users table (without hashing)
    $update_query = "UPDATE `users` SET password = '$new_password' WHERE email = '$email'";

    if (mysqli_query($conn, $update_query)) {
        // Password updated successfully
        echo "<script>alert('Password updated successfully.')</script>";
        echo "<script>window.location.href = '../../profile/login.html';</script>"; // Redirect to login page
        exit();
    } else {
        // Error updating password
        echo "<script>alert('Error updating password: " . mysqli_error($conn) . "')</script>";
        echo "<script>window.location.href = 'forgot_pass_3.html';</script>"; // Redirect to update password page
        exit();
    }
} else {
    // If accessed directly, redirect to the update password page
    header("Location: forgot_pass_3.html");
    exit();
}
?>
