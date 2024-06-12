<?php
// Include database connection file
include_once 'config.php';

// Initialize a variable to hold the success message
$message = "";

// Check if appointment ID is provided in the URL
if(isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    
    // Fetch appointment details from petvet1 table
    $sql_select_appointment = "SELECT * FROM petvet1 WHERE id = $appointment_id";
    $result_select_appointment = mysqli_query($conn, $sql_select_appointment);

    // If appointment found, move it to approved_appointments table and then delete from petvet1 table
    if(mysqli_num_rows($result_select_appointment) > 0) {
        $row = mysqli_fetch_assoc($result_select_appointment);

        // Insert appointment into approved_appointments table
        $sql_insert_approved = "INSERT INTO approved_appointments (username, appointmentDate, appointmentTime, numberOfPets, phoneNumber, petType) VALUES ('".$row['username']."', '".$row['appointmentDate']."', '".$row['appointmentTime']."', '".$row['numberOfPets']."', '".$row['phoneNumber']."', '".$row['petType']."')";
        mysqli_query($conn, $sql_insert_approved);

        // Delete appointment from petvet1 table
        $sql_delete_appointment = "DELETE FROM petvet1 WHERE id = $appointment_id";
        mysqli_query($conn, $sql_delete_appointment);

        // Set success message
        $message = "Appointment approved successfully.";
    } else {
        // If appointment not found, set error message
        $message = "Error: Appointment not found.";
    }
} else {
    // If appointment ID is not provided, set error message
    $message = "Error: Appointment ID not provided.";
}

// Close database connection
mysqli_close($conn);

// Display the success message
echo "<script>alert('$message'); window.location.href = 'appointment.php';</script>";
?>
