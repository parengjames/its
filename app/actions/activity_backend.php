<?php

include('../../config/db_connect.php'); // the database connection...........

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // add activity
    if (isset($_POST['add_activity'])) {

        $act_name = $_POST['activity_name'];
        $lesson = $_POST['lesson_id'];
        $act_totalquestion = $_POST['total_question'];
        $act_totalpoints = $_POST['total_points'];
        $act_passed = $_POST['pass_grade'];

        $sql_query = mysqli_query($con, "INSERT INTO `activity`(`activity_name`, `total_questions`, `total_points`, `passing_grade`, `lesson_id`) 
        VALUES ('$act_name','$act_totalquestion','$act_totalpoints','$act_passed','$lesson')");
        if ($sql_query) {
            $_SESSION['ico'] = 'success';
            $_SESSION['title'] = 'The activity has been added.';
            header("location: ../index.php?page=_activities&status=success");
        } else {
            $_SESSION['ico'] = 'error';
            $_SESSION['title'] = 'Upload error, Try again';
            header("location: ../index.php?page=_activities&status=failed");
        }
        //edit activity
    } else if (isset($_POST['edit_activity'])) {
        $activity_id = $_POST['activity_id'];
        $activity_name = $_POST['activity_name'];
        $total_question = $_POST['total_question'];
        $total_points = $_POST['total_points'];
        $pass = $_POST['pass_grade'];

        $still = $_POST['still_lesson'];
        $changed = $_POST['changed_lesson'];
        if ($changed == "" || $changed == '-- select here to changes --') {
            // unchanged or no new selection.........
            $query = mysqli_query($con, "SELECT * FROM `lesson` WHERE `lesson_title`='$still'");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $lesson_id = $row['lesson_id'];
                }
                // query to update data on database...............
                $updatequery = mysqli_query($con, "UPDATE `activity` SET `activity_name`='$activity_name',`total_questions`='$total_question',
                `total_points`='$total_points',`passing_grade`='$pass',`lesson_id`='$lesson_id' 
                WHERE `activity_id` = '$activity_id'");
                $_SESSION['ico'] = 'success';
                $_SESSION['title'] = 'The activity has been updated.';
                header("location: ../index.php?page=_activities&status=success");
            } else {
                echo "No data found.";
            }
        } else {
            // query to update data on database...............
            $updatequery = mysqli_query($con, "UPDATE `activity` SET `activity_name`='$activity_name',`total_questions`='$total_question',
                            `total_points`='$total_points',`passing_grade`='$pass',`lesson_id`='$changed' 
                            WHERE `activity_id` = '$activity_id'");
            $_SESSION['ico'] = 'success';
            $_SESSION['title'] = 'The activity has been updated.';
            header("location: ../index.php?page=_activities&status=success");
        }
    } else if (isset($_POST['delete_activity'])) {

        $activityid = $_POST['act_id'];
        // delete the activity................................
        $activity_query_delete = mysqli_query($con, "DELETE FROM `activity` WHERE `activity_id`=$activityid");
        if ($activity_query_delete) {
            $_SESSION['ico'] = 'success';
            $_SESSION['title'] = 'The Activity has been successfully removed.';
            header("location: ../index.php?page=_activities&status=success");
        } else {
            $_SESSION['ico'] = 'error';
            $_SESSION['title'] = "Deletion Failed.";
            header("location: ../index.php?page=_activities&status=failed");
        }
    } else if(isset($_POST['add_question'])){

        $question_num = $_POST['number'];
        $question = $_POST['quiz_question'];
        $choice1 = $_POST['choice_1'];
        $choice2 = $_POST['choice_2'];
        $choice3 = $_POST['choice_3'];
        $choice4 = $_POST['choice_4'];
        $answerkey = $_POST['answerkey'];
        $hint1 = $_POST['hint1'];
        $hint2 = $_POST['hint2'];
        $hint3 = $_POST['hint3'];

        if (isset($_FILES['hint2']['name']) && $_FILES['hint2']['name'] != '') {
            $target_dir = "hint_pictures/";
            $target_file = $target_dir . basename($_FILES["hint2"]["name"]);
            $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extentions_arr = array("png", "jpg", "jpeg");
            //check the file extension or file type...........
            if (in_array($FileType, $extentions_arr)) {
                // check the file size
                if ($_FILES['hint2']['size'] >= 26000000 || $_FILES['hint2']['size'] == "") {
                    $_SESSION['ico'] = "error";
                    $_SESSION['text'] = "The File is too large. File must be less than 25mb.";
                    header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
                }
                // upload picture........
                else {
                    if (move_uploaded_file($_FILES["hint2"]["tmp_name"], $target_file)) {

                        $_query = mysqli_query($con, "INSERT INTO `lesson_video`(`lesson_id`, `playlist`,`video_control_number`,`video_location`) 
                        VALUES ('$lesson','" . basename($_FILES["video_upload"]["name"]) . "',$control_num,'$target_file')");

                        $_SESSION['ico'] = "success";
                        $_SESSION['text'] = "The file " . basename($_FILES["video_upload"]["name"]) . " has been uploaded.";
                        header("location: ../index.php?page=_lessons_add&good=success#uploadvideo");
                    } else {
                        $_SESSION['ico'] = "error";
                        $_SESSION['text'] = "Sorry, there was an error uploading your file.";
                        header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
                    }
                }
            } else {
                $_SESSION['ico'] = "error";
                $_SESSION['text'] = "Sorry, File inserted is not a video file.";
                header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
            }
        }

    }
}
