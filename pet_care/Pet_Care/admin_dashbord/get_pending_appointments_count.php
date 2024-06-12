<?php
include_once 'config.php';

$sql = "SELECT COUNT(*) AS total FROM petvet1"; // Assuming petvet1 is the table for pending appointments
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalPendingAppointments = $row['total'];
    echo "<h1>$totalPendingAppointments</h1>";
} else {
    echo "Error: Unable to fetch total pending appointments.";
}
?>
