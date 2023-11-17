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

        //query of the hint 2 image for deletion..........
        $hint_delete = mysqli_query($con,"SELECT * FROM `quiz` WHERE `activity_id`='$activityid'");
        $hint_del_result = mysqli_num_rows($hint_delete);
        if($hint_del_result > 0){
            while($row = mysqli_fetch_assoc($hint_delete)){
                $_image_name = $row['hint2'];
                $image_path = "hint_pictures/";
                $image_delete = $image_path . $_image_name;

                //delete the image in local folder....
                unlink($image_delete);
                $_delete_image = mysqli_query($con," DELETE FROM `quiz` WHERE `activity_id` = $activityid");
            }
        }

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
    } else if (isset($_POST['add_question'])) {

        $act_id = $_POST['activity_id'];
        $question_num = $_POST['number'];
        $question = $_POST['quiz_question'];
        $choice1 = $_POST['choice_1'];
        $choice2 = $_POST['choice_2'];
        $choice3 = $_POST['choice_3'];
        $choice4 = $_POST['choice_4'];
        $answerkey = $_POST['answerkey'];
        $hint1 = $_POST['hint1'];
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
                    header("location: ../index.php?page=_add_quiz&status=failed&activity=$act_id");
                }
                // upload picture........
                else {
                    if (move_uploaded_file($_FILES["hint2"]["tmp_name"], $target_file)) {
                        // save to database...
                        $_query = mysqli_query($con, "INSERT INTO `quiz`(`quiz_number`, `quiz_question`, `quiz_ch1`, `quiz_ch2`, `quiz_ch3`, `quiz_ch4`, `answer_key`, `hint1`, `hint2`, `hint3`, `activity_id`) 
                        VALUES ('$question_num','$question','$choice1','$choice2','$choice3','$choice4','$answerkey','$hint1','" . basename($_FILES["hint2"]["name"]) . "','$hint3','$act_id')");

                        $_SESSION['ico'] = "success";
                        $_SESSION['text'] = "Question item is uploaded successfully";
                        header("location: ../index.php?page=_add_quiz&status=success&activity=$act_id");
                    } else {
                        $_SESSION['ico'] = "error";
                        $_SESSION['text'] = "Error in saving the image to local folder.";
                        header("location: ../index.php?page=_add_quiz&status=failed&activity=$act_id");
                    }
                }
            } else {
                $_SESSION['ico'] = "error";
                $_SESSION['text'] = "Sorry, File inserted is not a image type, in hint 2";
                header("location: ../index.php?page=_add_quiz&status=failed&activity=$act_id");
            }
        } else {
            $_SESSION['ico'] = "error";
            $_SESSION['text'] = "No image file detected";
            header("location: ../index.php?page=_add_quizs&status=failed&activity=$act_id");
        }
        // Delete the question.........
    } else if (isset($_POST['delete_question'])) {

        if (isset($_POST['que-id'])) {
            $question_id = $_POST['que-id'];
            $activity_id = $_SESSION['activity_id'];
            $name_hint2 = $_POST['hint_2'];

            // also delete the hint picture in local folder......
            $path_delete = "hint_pictures/" . $name_hint2;
            // Use unlink() function to delete a file 
            $delete_query = mysqli_query($con, "DELETE FROM `quiz` WHERE `quiz_id` =$question_id");
            if ($delete_query) {
                unlink($path_delete);
                $_SESSION['ico'] = "success";
                $_SESSION['text'] = "The question has been deleted";
                header("location: ../index.php?page=_add_quiz&status=success&activity=$activity_id");
            } else {
                $_SESSION['ico'] = "error";
                $_SESSION['text'] = "Something is wrong, DB error.";
                header("location: ../index.php?page=_add_quiz&status=failed&activity=$activity_id");
            }
        } else {
            $_SESSION['ico'] = "error";
            $_SESSION['text'] = "Question ID is not detected";
            header("location: ../index.php?page=_add_quiz&status=failed&activity=$activity_id");
        }
        // update the question data..........
    } else if (isset($_POST['update_question'])) {

        $item_id = $_POST['item_id'];
        $activity = $_POST['activity_id'];
        $quiz_num = $_POST['number'];
        $quiz_question = $_POST['quiz_question'];
        $quiz_choice1 = $_POST['choice_1'];
        $quiz_choice2 = $_POST['choice_2'];
        $quiz_choice3 = $_POST['choice_3'];
        $quiz_choice4 = $_POST['choice_4'];
        $quiz_answer = $_POST['answerkey'];
        $quiz_hint1 = $_POST['hint1'];
        $quiz_hint3 = $_POST['hint3'];

        // if hint2 image is updated........
        if (isset($_FILES['hint2_new']['name']) && $_FILES['hint2_new']['name'] != '') {
            $target_dir = "hint_pictures/";
            $target_file = $target_dir . basename($_FILES["hint2_new"]["name"]);
            $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extentions_arr = array("png", "jpg", "jpeg");
            //check the file extension or file type...........
            if (in_array($FileType, $extentions_arr)) {
                // check the file size
                if ($_FILES['hint2_new']['size'] >= 26000000 || $_FILES['hint2_new']['size'] == "") {
                    $_SESSION['ico'] = "error";
                    $_SESSION['text'] = "The File is too large. File must be less than 25mb.";
                    header("location: ../index.php?page=_add_quiz&status=failed&activity=$activity");
                }
                // upload picture........
                else {
                    if (move_uploaded_file($_FILES["hint2_new"]["tmp_name"], $target_file)) {
                        // update data to database...
                        $updatequery = mysqli_query($con, "UPDATE `quiz` SET `quiz_number`='$quiz_num',`quiz_question`='$quiz_question',
                        `quiz_ch1`='$quiz_choice1',`quiz_ch2`='$quiz_choice2',`quiz_ch3`='$quiz_choice3',
                        `quiz_ch4`='$quiz_choice4',`answer_key`='$quiz_answer',`hint1`='$quiz_hint1',
                        `hint2`='" . basename($_FILES["hint2_new"]["name"]) . "',`hint3`='$quiz_hint3' WHERE `quiz_id`='$item_id'");

                        $_SESSION['ico'] = "success";
                        $_SESSION['text'] = "Question item is updated successfully";
                        header("location: ../index.php?page=_add_quiz&status=success&activity=$activity");
                    } else {
                        $_SESSION['ico'] = "error";
                        $_SESSION['text'] = "Error in saving the image to local folder.";
                        header("location: ../index.php?page=_add_quiz&status=failed&activity=$activity");
                    }
                }
            } else {
                $_SESSION['ico'] = "error";
                $_SESSION['text'] = "Sorry, File inserted is not a image type, in hint 2";
                header("location: ../index.php?page=_add_quiz&status=failed&activity=$act_id");
            }
            // if hint 2 image is still the same.............
        } else {
            $updatequery = mysqli_query($con, "UPDATE `quiz` SET `quiz_number`='$quiz_num',`quiz_question`='$quiz_question',
                        `quiz_ch1`='$quiz_choice1',`quiz_ch2`='$quiz_choice2',`quiz_ch3`='$quiz_choice3',
                        `quiz_ch4`='$quiz_choice4',`answer_key`='$quiz_answer',`hint1`='$quiz_hint1',
                        `hint2`='" . $_POST['hint2_unchanged'] . "',`hint3`='$quiz_hint3' WHERE `quiz_id`='$item_id'");
            if ($updatequery) {
                $_SESSION['ico'] = "success";
                $_SESSION['text'] = "Question item is updated successfully";
                header("location: ../index.php?page=_add_quiz&status=success&activity=$activity");
            } else {
                $_SESSION['ico'] = "error";
                $_SESSION['text'] = "System error, Try again later.";
                header("location: ../index.php?page=_add_quiz&status=success&activity=$activity");
            }
        }
    }
}
