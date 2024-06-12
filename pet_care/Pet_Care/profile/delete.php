<?php
include 'config.php';
$id = $_GET['id'];

// Prepare the delete query
$delete_query = "DELETE FROM `users` WHERE id = ?";
$stmt = mysqli_prepare($conn, $delete_query);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo "<script>alert('Deleted Successfully!!')</script>";
    header("Location: index.html");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    echo "<script>alert('Failed to Delete!!')</script>";
    header("Location: index.html");
    exit();
}
?>
