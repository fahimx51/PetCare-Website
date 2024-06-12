<?php
include_once 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM temp_users WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)){
        $stmt->bind_param("i", $param_id);
        
        $param_id = $id;
        
        if($stmt->execute()){
            header("location: admin_dashbord.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    $stmt->close();
    
    $conn->close();
} else{
    header("location: error.php");
    exit();
}
?>
