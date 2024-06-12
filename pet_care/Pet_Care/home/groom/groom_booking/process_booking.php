<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    echo "Redirecting to login page...";
    header("Location: ../../../profile/login.html");
    exit();
}
include 'config.php';
$userEmail = $_SESSION['email'];
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function sanitizeInput($input) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars(strip_tags($input)));
}

// Validate and retrieve data from the form
$serviceType = sanitizeInput($_POST['serviceType']);
$petName = sanitizeInput($_POST['petName']);
$petAge = sanitizeInput($_POST['petAge']);
$petColor = sanitizeInput($_POST['petColor']);

// Insert data into the database along with user email
$insertQuery = "INSERT INTO booking_data (user_email, service_type, pet_name, pet_age, pet_color) 
                VALUES ('$userEmail', '$serviceType', '$petName', '$petAge', '$petColor')";

if ($conn->query($insertQuery) === TRUE) {
  include 'success_template.html';
} else {
    echo "Error in booking. Please try again.";
    error_log("Error: " . $insertQuery . "<br>" . $conn->error);
}
$conn->close();
?>
