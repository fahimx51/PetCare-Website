<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Appointments</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('../admin_dashbord/admin_img/admin_background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Fix the background image */
            background-position: center;
            color: #444;
        }

        h2 {
            color: #333;
            text-align: center;
            padding-top: 20px;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .appointment-table {
            width: 90%;
            margin: 0 auto; /* Center the table */
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9); /* Slight transparency */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Clip content within rounded corners */
            margin-bottom: 50px; /* Add more space at the bottom */
        }

        .appointment-table th, .appointment-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .appointment-table th {
            background-color: #f7f7f7;
            color: #333;
            font-weight: bold;
        }

        .appointment-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .appointment-table tr:hover {
            background-color: #e0e0e0; /* Row hover effect */
        }

        .btn-delete {
            padding: 8px 16px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 800px) {
            .appointment-table, .appointment-table th, .appointment-table td {
                font-size: 14px; /* Smaller text for smaller screens */
            }

            .appointment-table {
                width: 95%; /* Adjust table width on smaller screens */
            }

            .btn-delete {
                padding: 6px 12px;
            }
        }

        /* Add some spacing at the bottom */
        body {
            margin-bottom: 50px;
        }
    </style>
</head>
<body>

<?php
// Include database connection file
include_once 'config.php';

// Fetch all approved appointments from the 'approved_appointments' table
$sql_appointments = "SELECT * FROM approved_appointments";
$result_appointments = mysqli_query($conn, $sql_appointments);

// Display approved appointments in a table with delete buttons
echo "<h2>Approved Appointments</h2>";
if (mysqli_num_rows($result_appointments) > 0) {
    echo "<table class='appointment-table'>";
    echo "<tr><th>ID</th><th>Username</th><th>Appointment Date</th><th>Appointment Time</th><th>Number of Pets</th><th>Phone Number</th><th>Pet Type</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_assoc($result_appointments)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['appointmentDate']."</td>";
        echo "<td>".$row['appointmentTime']."</td>";
        echo "<td>".$row['numberOfPets']."</td>";
        echo "<td>".$row['phoneNumber']."</td>";
        echo "<td>".$row['petType']."</td>";
        echo "<td>";
        echo "<a href='delete_appointment.php?id=".$row['id']."' class='btn-delete'>Delete</a>"; // Delete button
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align: center;'>No approved appointments found.</p>";
}
?>

</body>
</html>
