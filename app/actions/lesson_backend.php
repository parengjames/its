<?php

include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // lesson materials add..........
    if (isset($_POST['add_lesson'])) {
        $subject_id = $_POST['lesson_id'];
        $lesson_title = $_POST['title'];
        $lesson_description = $_POST['description'];
        $lesson_status = $_POST['status'];
        $lesson_material = $_POST['lesson_materials'];
        //checking the empty field..............
        if ($subject_id == "") {
            $_SESSION['ico'] = "error";
            $_SESSION['title'] = "The Subject ID must not be left blank.";
            header("location: ../index.php?page=_lessons_add&status=return");
        } else if ($lesson_title == "") {
            $_SESSION['ico'] = "error";
            $_SESSION['title'] = "The lesson Title must not be left blank.";
            header("location: ../index.php?page=_lessons_add&status=return");
        }
        //ready to save to db..........
        else {
            $sqlquery = mysqli_query($con, "INSERT INTO `lesson`(`lesson_title`, `lesson_description`, `subject_id`, `lesson_content`, `lesson_status`) 
            VALUES ('$lesson_title','$lesson_description','$subject_id','$lesson_material','$lesson_status')");

            if ($sqlquery) {
                $_SESSION['ico'] = "success";
                $_SESSION['title'] = "Lesson has been added succesfully";
                header("location: ../index.php?page=_lessons_add&status=success");
            } else {
                $_SESSION['ico'] = "error";
                $_SESSION['title'] = "Insert lesson failed";
                header("location: ../index.php?page=_lessons_add&status=failed");
            }
        }
        //insert new pdf files........
    } else if (isset($_POST['add_pdf'])) {

        $lesson = $_POST['lesson_id'];

        if ($lesson == "") {
            $_SESSION['text'] = "The Lesson id must not be left blank";
            header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
        } else {
            $target_dir = "pdf_uploads/";
            $target_file = $target_dir . basename($_FILES["pdf_upload"]["name"]);
            $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($FileType != "pdf") {
                $_SESSION['text'] = "The inserted file is not a PDF file.";
                header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
            } else {
                if (move_uploaded_file($_FILES["pdf_upload"]["tmp_name"], $target_file)) {

                    $_query = mysqli_query($con, "INSERT INTO `lesson_pdf`(`lesson_id`, `pdf_content`,`pdf_location`) 
                    VALUES ('$lesson','" . basename($_FILES["pdf_upload"]["name"]) . "','$target_file')");


                    $_SESSION['text'] = "The file " . basename($_FILES["pdf_upload"]["name"]) . " has been uploaded.";
                    header("location: ../index.php?page=_lessons_add&note=success#uploadpdf");
                } else {
                    $_SESSION['text'] = "Sorry, there was an error uploading your file.";
                    header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
                }
            }
        }

        // add video...........
    } else if (isset($_POST['add_video'])) {

        $lesson = $_POST['lesson_id'];

        if ($lesson == "") {
            $_SESSION['text'] = "The Lesson id must not be left blank";
            header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
        } else {

            if (isset($_FILES['video_upload']['name']) && $_FILES['video_upload']['name'] != '') {
                $target_dir = "video_upload/";
                $target_file = $target_dir . basename($_FILES["video_upload"]["name"]);
                $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $extentions_arr = array("mp4", "avi", "mov", "mpeg");
                //check the file extension or file type...........
                if (in_array($FileType, $extentions_arr)) {
                    // check the file size
                    if ($_FILES['video_upload']['size'] >= 500000000 || $_FILES['video_upload']['size'] == "") {
                        $_SESSION['text'] = "The File is too large. File must be less than 500mb.";
                        header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
                    }
                    // upload video........
                    else {
                        if (move_uploaded_file($_FILES["video_upload"]["tmp_name"], $target_file)) {

                            $_query = mysqli_query($con, "INSERT INTO `lesson_video`(`lesson_id`, `playlist`,`video_location`) 
                            VALUES ('$lesson','" . basename($_FILES["video_upload"]["name"]) . "','$target_file')");

                            $_SESSION['text'] = "The file " . basename($_FILES["video_upload"]["name"]) . " has been uploaded.";
                            header("location: ../index.php?page=_lessons_add&good=success#uploadvideo");
                        } else {
                            $_SESSION['text'] = "Sorry, there was an error uploading your file.";
                            header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
                        }
                    }
                }else{
                    $_SESSION['text'] = "Sorry, File inserted is not a video file.";
                    header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
                }
            }
        }
    }else if(isset($_POST['delete_lesson'])){

        if(isset($_POST['id'])){
            $lesson_id = $_POST['id'];

            

            $_query = mysqli_query($con,"");

        }else{

        }
    
    }
}
