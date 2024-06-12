<?php
    include 'config.php';

    $id = $_GET['id'];

    // Update operation
    if (isset($_POST['update'])) {
        // Function to sanitize and validate input
        function validateInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $name = validateInput($_POST['name']);
        $email = validateInput($_POST['email']);
        $address = validateInput($_POST['address']);
        
        // Validate name
        if (empty($name)) {
            echo "Name is required.";
            exit();
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit();
        }

        // Validate address
        if (empty($address)) {
            echo "Address is required.";
            exit();
        }

        // File upload
        $imageTempLocation = $_FILES['profile_picture']['tmp_name'];
        $imageName = $_FILES['profile_picture']['name'];
        $imageLocalLocation = "pic/" . $imageName;

        // Validate image upload
        $allowedFormats = ['jpeg', 'jpg', 'png', 'gif'];
        $fileFormat = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        if (!in_array($fileFormat, $allowedFormats)) {
            echo "Invalid file format. Please upload an image with formats: JPEG, JPG, PNG, GIF.";
            exit();
        }

        // Check file size (you can set your own size limit)
        $maxFileSize = 10 * 1024 * 1024; // 10MB in bytes
        if ($_FILES["profile_picture"]["size"] > $maxFileSize) {
        echo "<script> alert('File size exceeds the limit (10MB). Please choose a smaller file.') </script>";
        echo "<script> location.href='update.php' </script>";
        exit();
        }
        

        move_uploaded_file($imageTempLocation, $imageLocalLocation);

        $query = "UPDATE users SET name = '$name', email = '$email', 
        address = '$address', profile_picture = '$imageLocalLocation' WHERE id = '$id'";

        if (mysqli_query($conn, $query)) {
           // echo "Profile updated successfully.";
            echo "<script> location.href = 'profile.php?email=" . $email . " '</script>";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>
