<?php
// Connect to database (replace placeholders with your credentials)
include 'config.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get pet ID from URL parameter
$id = $_GET['id'];

// Prepare SQL query to delete pet
$sql = "DELETE FROM pets WHERE id = $id";

// Execute query
if (mysqli_query($conn, $sql)) {
    // Redirect to index page with success message
    header("Location: index.php?deleted=true");
    exit();
} else {
    echo "Error deleting pet: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>
