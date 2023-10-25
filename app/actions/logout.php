<?php
   if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../../config/db_connect.php");

if(isset($_POST['logout'])){
    // saving logs to database.........
    $sqlquery = mysqli_query($con,"INSERT INTO `action_logs`(`user_id`, `log_name`, `log_value`) 
    VALUES ('".$_SESSION['user_id']."','logout',0)");
    session_destroy();
    unset($_SESSION['loggedin']);
    header('Location:../../login.php?session=logout');
    exit(0);
}

?>