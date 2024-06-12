<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="../home/image/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="profile.css">   
</head>

<body>
    <?php
    include 'config.php';
    $email = $_GET['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container' style='max-width: 500px;'>";
        echo "<div class='profile'>";
        while ($row = mysqli_fetch_assoc($result)) {

            // Settings dropdown
            echo "<div class='dropdown ml-auto'>";

            echo "<button class='btn btn-link' onclick='goBack()' style='margin-right: 290px;'>";
            echo "<img src='../profile/image/house-check-fill.svg' alt='Home' style='width: 40px; height: 40px;'>";
            echo "</button>";

            echo "<button class='btn btn-link' type='button' id='settingsDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>";
            echo "<img src='../profile/image/gear-fill.svg' alt='Settings' style='width: 40px; height: 40px;'>";
            echo "</button>";

            echo "<div class='dropdown-menu dropdown-menu-right' aria-labelledby='settingsDropdown'>";

            echo "<a class='dropdown-item' href='delete.php?id=" . $row['id'] . "'><img src='../profile/image/trash3.svg' alt='Delete Icon' class='icon'> <span class='link-text'>Delete Account</span></a>";

            echo "<a class='dropdown-item' href='update.php?id=" . $row['id'] . "'><img src='../profile/image/arrow-up-circle-fill.svg' alt='Update Icon' class='icon'> <span class='link-text'>Update Account</span></a>";

            echo "<a class='dropdown-item' href='logout.php'><img src='../profile/image/box-arrow-left.svg' alt='Logout Icon' class='icon'> <span class='link-text'>Logout</span></a>";
            echo "</div>";
            echo "</div>";
            
            //Profile
            echo "<img src='" . $row['profile_picture'] . "' alt='Profile Picture' class='img-fluid'>";
            echo "<p class='mb-0'><b>Name:</b> <strong>" . $row['name'] . "</strong></p>";
            echo "<p class='mb-0'><b>Email:</b> " . $row['email'] . "</p>";
            echo "<p><b>Address:</b> " . $row['address'] . "</p>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "<div class='container text-center mt-5'>";
        echo "<p class='lead'>No profiles found.</p>";
        echo "</div>";
    }

    mysqli_close($conn);
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function goBack() {
            window.location.href = '../home/index.php?email=<?php echo $email; ?>';
        }
    </script>
</body>
</html>