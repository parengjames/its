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

} else if(isset($_GET['fromlesson'])){
    $user_id = $_SESSION['user_id'];
    $lessonID = $_GET['fromlesson'];

    $sqlfetch = mysqli_query($con,"SELECT * FROM `activity` WHERE lesson_id=$lessonID");
    $sqlresult = mysqli_num_rows($sqlfetch);
    if($sqlresult > 0){
        while($row = mysqli_fetch_assoc($sqlfetch)){
            $activity_id = $row['activity_id'];
        }
    }

    $sql1 = mysqli_query($con, "INSERT INTO `action_logs`(`user_id`, `log_name`, `log_value`) 
    VALUES ('$user_id','Take quiz','1')");

    $sql2 = mysqli_query($con, "INSERT INTO `quiz_logs`(`user_id`, `activity_id`, `status`) 
    VALUES ('$user_id','$activity_id',1)");

    // database query to get the value of attempts by users................
    $attemptquery = mysqli_query($con, "SELECT SUM(status) AS attempts FROM `quiz_logs` WHERE `user_id`=$user_id AND `activity_id`=$activity_id");
    $attemptquery_result = mysqli_num_rows($attemptquery);
    if($attemptquery_result > 0){
        while($row = mysqli_fetch_assoc($attemptquery)){
            $total_attempts = $row['attempts'];
        }
    }else{
        
    }  
    header("location: ../_lessons_quiz.php?activity=$activity_id&take=$total_attempts&item=1");

}else {
    echo "Lesson ID is missing/not detected.";
}