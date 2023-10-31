<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id'])){
        $_userid = $_POST['id'];

        $_sqlquery = mysqli_query($con,"DELETE FROM `users` WHERE `user_id` = '$_userid'");

        $_SESSION['ico'] = 'success';
        $_SESSION['title'] = 'The student has been successfully removed.';
        header("location: ../index.php?page=_students&status=success");
    }else{
        $_SESSION['ico'] = 'error';
        $_SESSION['title'] = "The system is unable to detect the student's ID";
        header("location: ../index.php?page=_students&status=failed");
    }  
}else{
    $_SESSION['ico'] = 'error';
    $_SESSION['title'] = 'No input detected';
    header("location: ../index.php?page=_students&status=failed");
}

?>