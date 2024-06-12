<?php
session_start();

include_once "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $admin = $result->fetch_assoc();

            if ($password === $admin["admin_password"]) {
                $_SESSION["admin_logged_in"] = true;
                header("Location: admin_dashboard.php");
                exit;
            } else {
                $error = "Invalid password";
                header("Location: admin_login.html");
            }
        } else {
            $error = "Invalid username";
            header("Location: admin_login.html");
        }
    }
}
?>
