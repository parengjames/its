<?php

include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // lesson materials add..........
    if (isset($_POST['add_lesson'])) {
        $subject_id = $_POST['lesson_id'];
        $lesson_title = $_POST['title'];
        $lesson_description = $_POST['description'];
        $lesson_status = $_POST['status'];
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
            $sqlquery = mysqli_query($con, "INSERT INTO `lesson`(`lesson_title`, `lesson_description`, `subject_id`, `lesson_status`) 
            VALUES ('" . $lesson_title . "','" . $lesson_description . "','" . $subject_id . "','" . $lesson_status . "')");

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
        $num_control = $_POST['control_number'];

        if ($lesson == "") {
            $_SESSION['ico'] = "warning";
            $_SESSION['text'] = "The Lesson id must not be left blank";
            header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
        } else if ($num_control == "") {
            $_SESSION['ico'] = "warning";
            $_SESSION['text'] = "The number control must not be left blank";
            header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
        } else {
            $target_dir = "pdf_uploads/";
            $target_file = $target_dir . basename($_FILES["pdf_upload"]["name"]);
            $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($FileType != "pdf") {
                $_SESSION['ico'] = "error";
                $_SESSION['text'] = "The inserted file is not a PDF file.";
                header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
            } else {
                if (move_uploaded_file($_FILES["pdf_upload"]["tmp_name"], $target_file)) {

                    $_query = mysqli_query($con, "INSERT INTO `lesson_pdf`(`lesson_id`, `pdf_content`,`pdf_control_number`,`pdf_location`) 
                    VALUES ('$lesson','" . basename($_FILES["pdf_upload"]["name"]) . "',$num_control,'$target_file')");

                    $_SESSION['ico'] = "success";
                    $_SESSION['text'] = "The file " . basename($_FILES["pdf_upload"]["name"]) . " has been uploaded.";
                    header("location: ../index.php?page=_lessons_add&note=success#uploadpdf");
                } else {
                    $_SESSION['ico'] = "error";
                    $_SESSION['text'] = "Sorry, there was an error uploading your file.";
                    header("location: ../index.php?page=_lessons_add&notif=return#uploadpdf");
                }
            }
        }

        // add video...........
    } else if (isset($_POST['add_video'])) {

        $lesson = $_POST['lesson_id'];
        $control_num = $_POST['control_number'];

        if ($lesson == "") {
            $_SESSION['ico'] = "warning";
            $_SESSION['text'] = "The Lesson id must not be left blank";
            header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
        } else if ($control_num == "") {
            $_SESSION['ico'] = "warning";
            $_SESSION['text'] = "The number control must not be left blank";
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
                        $_SESSION['ico'] = "error";
                        $_SESSION['text'] = "The File is too large. File must be less than 500mb.";
                        header("location: ../index.php?page=_lessons_add&error=return#uploadvideo");
                    }
                    // upload video........
                    else {
                        if (move_uploaded_file($_FILES["video_upload"]["tmp_name"], $target_file)) {

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
    } else if (isset($_POST['delete_lesson'])) {

        if (isset($_POST['id'])) {
            $lesson_id = $_POST['id'];

            //query of the pdf table - unahon ang pdf ug delete..........
            $pdfquery = mysqli_query($con, "SELECT * FROM `lesson_pdf` WHERE `lesson_id`='$lesson_id'");
            $pdfquery_result = mysqli_num_rows($pdfquery);
            if ($pdfquery_result > 0) {
                while ($row = mysqli_fetch_assoc($pdfquery)) {
                    $_pdfid = $row['pdf_id'];
                    $_location = $row['pdf_location'];
                    // now delete the pdf in local directory folder........
                    $pdf_to_delete = $_location;
                    if (unlink($pdf_to_delete)) {
                        // now delete the pdf in database.........
                        $_deletesql = mysqli_query($con, "DELETE FROM `lesson_pdf` WHERE `pdf_id` = '$_pdfid'");
                    }
                }
            }

            //query of the video table - sunod i delete ang video..........
            $videoquery = mysqli_query($con, "SELECT * FROM `lesson_video` WHERE `lesson_id`='$lesson_id'");
            $videoquery_result = mysqli_num_rows($videoquery);
            if ($videoquery_result > 0) {
                while ($row = mysqli_fetch_assoc($videoquery)) {
                    $_vid = $row['video_id'];
                    $_location = $row['video_location'];
                    // now delete the pdf in local directory folder........
                    $video_to_delete = $_location;
                    if (unlink($video_to_delete)) {
                        // now delete the pdf in database.........
                        $_deletesql = mysqli_query($con, "DELETE FROM `lesson_video` WHERE `video_id` = '$_vid'");
                    }
                }
            }

            //query of the content table - sunod i delete ang content..........
            $query = mysqli_query($con, "SELECT * FROM `lesson_content` WHERE `lesson_id`='$lesson_id'");
            $query_result = mysqli_num_rows($query);
            if ($query_result > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $_cid = $row['content_id'];
                    // now delete the pdf in database.........
                    $_sqlqueryyy = mysqli_query($con, "DELETE FROM `lesson_content` WHERE `content_id`=$_cid");
                }
            }

            // now delete the lesson..........................................
            $_lessonquery = mysqli_query($con, "DELETE FROM `lesson` WHERE `lesson_id`=$lesson_id");
            if ($_lessonquery) {
                $_SESSION['icon'] = "success";
                $_SESSION['content'] = "Lesson deleted successfully";
                header("location: ../index.php?page=_lessons&notif=success");
            }
        } else {
            echo "no data found";
        }
    } else if (isset($_POST['add_content'])) {

        $lesson = $_POST['lesson_id'];
        $content = $_POST['lesson_materials'];
        $number_order = $_POST['number'];

        if ($lesson == "") {
            $_SESSION['text'] = "The Lesson id must not be left blank";
            header("location: ../index.php?page=_lessons_add&deny=return#uploadcontent");
        } else if ($content == "") {
            $_SESSION['text'] = "The content must not be left blank";
            header("location: ../index.php?page=_lessons_add&deny=return#uploadcontent");
        } else if ($number_order == 0 || $number_order == null) {
            $_SESSION['text'] = "The number order must not be left blank";
            header("location: ../index.php?page=_lessons_add&deny=return#uploadcontent");
        } else {
            $sql_query = mysqli_query($con, "INSERT INTO `lesson_content`(`content_body`,`num_order` ,`lesson_id`) 
            VALUES ('" . $content . "',$number_order,'" . $lesson . "')");
            if ($sql_query) {
                $_SESSION['text'] = "The content uploaded successfully";
                header("location: ../index.php?page=_lessons_add&give=way#uploadcontent");
            } else {
                $_SESSION['text'] = "There is an error in uploading content.";
                header("location: ../index.php?page=_lessons_add&deny=return#uploadcontent");
            }
        }
        // update ang content............diri na dapita..........
    } else if (isset($_POST['update_content'])) {
        $content_id = $_POST['con_id'];
        $number = $_POST['number'];
        $content = $_POST['lesson_materials'];

        $_update_content_query = mysqli_query($con, "UPDATE `lesson_content` SET `content_body`='$content',`num_order`=$number 
        WHERE `content_id`= '$content_id'");
        $_SESSION['text'] = "The content updated successfully";
        header("location: ../index.php?page=_view_materials&content=$content_id&stats=success");
        // update sa lesson information diri dapita...............
    } else if (isset($_POST['update_lesson'])) {

        if (isset($_POST['id'])) {
            $_lid = $_POST['id'];
            $_ltitle = $_POST['lesson_title'];
            $_ldesc = $_POST['lesson_desc'];
            $_Lstatus = $_POST['lesson_status'];

            $changed = $_POST['changed_subject'];
            $subject_name = $_POST['still_subject'];

            if ($changed == "" || $changed == "Select to make change") {
                // unchanged subject
                // query to get the subject id.....
                $subject_query = mysqli_query($con, "SELECT * FROM `subject` WHERE `subject_name`='$subject_name'");
                $result = mysqli_num_rows($subject_query);
                if ($result > 0) {
                    while ($row = mysqli_fetch_assoc($subject_query)) {
                        $subject_id = $row['subject_id'];
                    }
                    // query to update
                    $updatesql = mysqli_query($con, "UPDATE `lesson` SET `lesson_title`='$_ltitle',`lesson_description`='$_ldesc',`subject_id`='$subject_id',`lesson_status`='$_Lstatus'
                    WHERE `lesson_id` = '$_lid'");

                    $_SESSION['icon'] = "success";
                    $_SESSION['content'] = "Lesson updated successfully";
                    header("location: ../index.php?page=_lessons&notif=success");
                } else {
                    echo "no data found";
                }
            } else {
                // query to update
                $updatesql = mysqli_query($con, "UPDATE `lesson` SET `lesson_title`='$_ltitle',`lesson_description`='$_ldesc',`subject_id`='$changed',`lesson_status`='$_Lstatus'
                WHERE `lesson_id` = '$_lid'");
                $_SESSION['icon'] = "success";
                $_SESSION['content'] = "Lesson updated successfully";
                header("location: ../index.php?page=_lessons&notif=success");
            }
        } else {
            $_SESSION['icon'] = "error";
            $_SESSION['content'] = "Update lesson failed.";
            header("location: ../index.php?page=_lessons&notif=failed");
        }
    }
}
