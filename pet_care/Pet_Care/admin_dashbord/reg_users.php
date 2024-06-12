<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
            body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-image: url('../admin_dashbord/admin_img/admin_background.jpg');
  background-size: cover;
  background-repeat: no-repeat;
}
        

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .user-table th, .user-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #f7f7f7;
            color: #333;
            font-weight: bold;
        }

        .user-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .no-img {
            font-style: italic;
            color: #999;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-edit:hover, .btn-delete:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
// Include database connection file
include_once 'config.php';

// Fetch all users from the 'users' table
$sql_users = "SELECT * FROM users";
$result_users = mysqli_query($conn, $sql_users);

// Display users from the 'users' table in a table with CRUD buttons
echo "<h2>Users</h2>";
if (mysqli_num_rows($result_users) > 0) {
    echo "<table class='user-table'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Confirm Password</th><th>Address</th><th>Profile Picture</th><th>Status</th><th>Verification Code</th><th>Verification Timestamp</th><th>Actions</th></tr>";
    while ($row = mysqli_fetch_assoc($result_users)) {
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
        echo "<td>".$row['status']."</td>";
        echo "<td>".$row['verification_code']."</td>";
        echo "<td>".$row['verification_timestamp']."</td>";
        echo "<td>";
        // echo "<a href='edit_user.php?id=".$row['id']."' class='btn-edit'>Edit</a>"; // Edit button
        echo "<a href='delete_user.php?id=".$row['id']."' class='btn-delete'>Delete</a>"; // Delete button
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
?>

</body>
</html>
