<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id'])){
        $subjectid = $_POST['id'];

        $_sqlquery = mysqli_query($con,"DELETE FROM `subject` WHERE `subject_id` = '$subjectid'");

        $_SESSION['ico'] = 'success';
        $_SESSION['title'] = 'The Course has been successfully removed.';
        header("location: ../index.php?page=_course&status=success");
    }else{
        $_SESSION['ico'] = 'error';
        $_SESSION['title'] = "The system is unable to detect the Course's ID";
        header("location: ../index.php?page=_course&status=failed");
    }  
}else{
    $_SESSION['ico'] = 'error';
    $_SESSION['title'] = 'No input detected';
    header("location: ../index.php?page=_course&status=failed");
}

?>