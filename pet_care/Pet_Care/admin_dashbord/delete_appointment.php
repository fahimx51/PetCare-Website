<?php
// Include database connection file
include_once 'config.php';

// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Delete the appointment from the 'approved_appointments' table
    $sql_delete_appointment = "DELETE FROM approved_appointments WHERE id = $appointment_id";
    if(mysqli_query($conn, $sql_delete_appointment)) {
        // Appointment deleted successfully
        // No need to send any response
    } else {
        // Error occurred while deleting appointment
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If appointment ID is not provided
    echo "Error: Appointment ID not provided.";
}

// Close database connection
mysqli_close($conn);
?>
<meta http-equiv="refresh" content="0;URL='approved_appointments.php'">
