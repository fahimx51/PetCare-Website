<?php
include_once 'config.php';

if (isset($_GET['id'])) {
    $tempUserID = $_GET['id'];

    $sql_select_temp_user = "SELECT * FROM temp_users WHERE id = $tempUserID";
    $result_select_temp_user = mysqli_query($conn, $sql_select_temp_user);

    if (mysqli_num_rows($result_select_temp_user) > 0) {
        $tempUserData = mysqli_fetch_assoc($result_select_temp_user);

        $sql_insert_user = "INSERT INTO users (name, email, password, confirm_pass, address, profile_picture, verification_code, status)
                            VALUES ('".$tempUserData['name']."', '".$tempUserData['email']."', '".$tempUserData['password']."', '".$tempUserData['confirm_pass']."', '".$tempUserData['address']."', '".$tempUserData['profile_picture']."', '".$tempUserData['verification_code']."', '".$tempUserData['status']."')";
        $result_insert_user = mysqli_query($conn, $sql_insert_user);

        if ($result_insert_user) {
            $sql_delete_temp_user = "DELETE FROM temp_users WHERE id = $tempUserID";
            $result_delete_temp_user = mysqli_query($conn, $sql_delete_temp_user);

            if ($result_delete_temp_user) {
                header("Location: reg_users.php?status=success");
                exit;
            } else {
                header("Location: temp_user.php?status=error_delete_temp_user");
                exit;
            }
        } else {
            header("Location: temp_user.php?status=error_insert_user");
            exit;
        }
    } else {
        header("Location: admin_dashboard.php?status=temp_user_not_found");
        exit;
    }
} else {
    header("Location: admin_dashboard.php?status=no_id");
    exit;
}
?>
