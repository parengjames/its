<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // pdf ni diri na side.........
    if (isset($_POST['delete_pdf'])) {
        $_pdfid = $_POST['id'];
        $_lessonID = $_SESSION['l_id'];

        //query sa sa pdf table kay kwaun ang pdf location ug name........
        $_sql1 = mysqli_query($con, "SELECT * FROM `lesson_pdf` WHERE `pdf_id` = '$_pdfid'");
        $_sql1_result = mysqli_num_rows($_sql1);
        if ($_sql1_result > 0) {
            while ($row = mysqli_fetch_assoc($_sql1)) {
                $pdf_name = $row['pdf_content'];
                $pdf_location = $row['pdf_location'];

                $filetodelete = $pdf_location;
                // Use unlink() function to delete a file 
                if (unlink($filetodelete)) {
                    // then pwede na idelete ang data sa database..........
                    $_deletesql = mysqli_query($con, "DELETE FROM `lesson_pdf` WHERE `pdf_id` = '$_pdfid'");
                    if ($_deletesql) {
                        //true
                        $_SESSION['ico'] = 'success';
                        $_SESSION['title'] = "'" . $pdf_name . "' deleted successfully";
                        header("location: ../index.php?page=_materials&lesson=$_lessonID&status=success");
                    }
                }
            }
        } else {
            echo "no data found";
        }
        //video ni diri na side
    } else if (isset($_POST['delete_video'])) {
        $_vid = $_POST['video_id'];
        $_lessonID = $_SESSION['l_id'];

        //query sa sa video table kay kwaun ang video location ug name........
        $_sql1 = mysqli_query($con, "SELECT * FROM `lesson_video` WHERE `video_id` = '$_vid'");
        $_sql1_result = mysqli_num_rows($_sql1);
        if ($_sql1_result > 0) {
            while ($row = mysqli_fetch_assoc($_sql1)) {
                $video_name = $row['playlist'];
                $video_location = $row['video_location'];

                $filetodelete = $video_location;
                // Use unlink() function to delete a file 
                if (unlink($filetodelete)) {
                    // then pwede na idelete ang data sa database..........
                    $_deletesql = mysqli_query($con, "DELETE FROM `lesson_video` WHERE `video_id` = '$_vid'");
                    if ($_deletesql) {
                        //true
                        $_SESSION['ico'] = 'success';
                        $_SESSION['title'] = "'" . $video_name . "'Deleted successfully";
                        header("location: ../index.php?page=_materials&lesson=$_lessonID&status=success");
                    }
                }
            }
        } else {
            echo "no data found";
        }
    } else if (isset($_POST['delete_content'])) {

        if (isset($_POST['content_id'])) {
            $content = $_POST['content_id'];
            $_lessonID = $_SESSION['l_id'];

            $_sqlqueryyy = mysqli_query($con, "DELETE FROM `lesson_content` WHERE `content_id`=$content");
            $_SESSION['ico'] = 'success';
            $_SESSION['title'] = "Content deleted successfully";
            header("location: ../index.php?page=_materials&lesson=$_lessonID&status=success");
        } else {
            $_SESSION['ico'] = 'error';
            $_SESSION['title'] = "Failed, error in deletion.";
            header("location: ../index.php?page=_materials&lesson=$_lessonID&status=failed");
        }
    }
}
