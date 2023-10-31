<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $c_id = $_POST['id'];
    $c_name = $_POST['coursename'];
    $c_about = $_POST['description'];

    if ($c_name == "") {
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "The course name field is blank.";
        header("location: ../index.php?page=_course&status=return");
    } else if ($c_about == "") {
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "The course description field is blank.";
        header("location: ../index.php?page=_course&status=return");
    } else {
        $sql_query = mysqli_query($con, "UPDATE `subject` SET `subject_name`='$c_name',`subject_about`='$c_about' WHERE `subject_id`='$c_id'");

        $_SESSION['ico'] = "success";
        $_SESSION['title'] = "The course has been updated.";
        header("location: ../index.php?page=_course&status=success");
    }
}else{
    $_SESSION['ico'] = "error";
    $_SESSION['title'] = "No data input found";
    header("location: ../index.php?page=_course&status=return");
}

?>
