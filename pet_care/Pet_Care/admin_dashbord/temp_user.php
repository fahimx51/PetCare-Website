<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary Users</title>
    <style>
        /* Style for user table */
        .user-table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .user-table th {
            background-color: #f2f2f2;
        }

        .user-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .user-table tr:hover {
            background-color: #ddd;
        }

        .user-table img {
            max-width: 50px;
            max-height: 50px;
        }

        .no-img {
            font-style: italic;
        }

        /* Style for buttons */
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 5px;
            margin-bottom: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-approve {
            background-color: #4CAF50;
            color: white;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
<?php
// Include database connection file
include_once 'config.php';

// Fetch all temporary users from the 'temp_users' table
$sql_temp_users = "SELECT * FROM temp_users";
$result_temp_users = mysqli_query($conn, $sql_temp_users);

// Display temporary users in a table with CRUD buttons
echo "<h2 style='color: #333; font-size: 24px; margin-bottom: 20px;'>Temporary Users</h2>";
if (mysqli_num_rows($result_temp_users) > 0) {
    echo "<div class='table-container'>";
    echo "<table class='user-table'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Confirm Password</th><th>Address</th><th>Profile Picture</th><th>Verification Code</th><th>Created At</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_assoc($result_temp_users)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['password']."</td>";
        echo "<td>".$row['confirm_pass']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>";
        // Check if user has a profile image
        $profileImagePath = $row['profile_picture'];
        if (!empty($profileImagePath) && file_exists($profileImagePath)) {
            echo "<img src='$profileImagePath' class='profile-img' alt='Profile Image'>";
        } else {
            echo "<div class='no-img'>No Image</div>";
        }
        echo "</td>";
        echo "<td>".$row['verification_code']."</td>";
        echo "<td>".$row['created_at']."</td>";
        echo "<td>";
        // Add buttons to delete and approve temporary users
        echo "<a href='delete_temp_user.php?id=".$row['id']."' class='btn btn-delete'>Delete</a>";
        echo "<a href='approve_temp_user.php?id=".$row['id']."' class='btn btn-approve'>Approve</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p style='color: #777; font-style: italic;'>No temporary users found.</p>";
}
?>
</body>
</html>
