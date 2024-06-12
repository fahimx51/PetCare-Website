<?php
// Include database connection file
include_once 'config.php';

// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Delete appointment from petvet1 table
    $sql_delete_appointment = "DELETE FROM petvet1 WHERE id = $appointment_id";
    mysqli_query($conn, $sql_delete_appointment);

    // Redirect back to the appointments page
    header("Location: appointment.php");
    exit();
} else {
    // If appointment ID is not provided, redirect back to the appointments page
    header("Location: appointment.php");
    exit();
}
?>
