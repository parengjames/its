<?php
include('../../config/db_connect.php'); // the database connection...........

if (isset($_GET['lesson'])) {
    $lesson_id = $_GET['lesson'];
    $user_id = $_SESSION['user_id'];
    $lesson_name = "[view] ".$_GET['name'];

    $sql = mysqli_query($con, "INSERT INTO `lesson_logs`(`user_id`, `lesson_id`, `isView_value`) 
        VALUES ('$user_id','$lesson_id','1')");

    $sql1 = mysqli_query($con, "INSERT INTO `action_logs`(`user_id`, `log_name`, `log_value`) 
        VALUES ('$user_id','" . $lesson_name . "','1')");

    header("location: ../index.php?page=_lesson_view&lesson=$lesson_id&side=unlock");
} else if (isset($_GET['course'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = $_GET['course'];
    $course = "[view] ".$_GET['name'];

    $sql2 = mysqli_query($con, "INSERT INTO `action_logs`(`user_id`, `log_name`, `log_value`) 
        VALUES ('$user_id','" . $course . "','1')");

    header("location: ../index.php?page=_lesson_student&course=$course_id");
} else {
    echo "Lesson ID is missing/not detected.";
}
