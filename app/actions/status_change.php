<?php
    include('../../config/db_connect.php'); // the database connection...........

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $userid = $_POST['id'];
        $action = $_POST['submit'];

        if($action == "approve"){
            $status = "Approved";
            $query = mysqli_query($con,"UPDATE `users` SET `user_status`='".$status."' WHERE user_id = '".$userid."'");

            $_SESSION['ico'] = "success";
            $_SESSION['title'] = "Student is now approved.";
            header("location: ../index.php?page=_students&status=approved");
        }else{
            $status = "Pending";
            $query = mysqli_query($con,"UPDATE `users` SET `user_status`='".$status."' WHERE user_id = '".$userid."'");

            $_SESSION['ico'] = "warning";
            $_SESSION['title'] = "Student is now restricted.";
            header("location: ../index.php?page=_students&status=approved");
        }
    }else{

    }
?>