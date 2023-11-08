<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id'])) {
        $subjectid = $_POST['id'];

        //query the lesson table to get the lesson_id connected to this subject.......
        $lesson_query = mysqli_query($con, "SELECT * FROM `lesson` WHERE `subject_id` = '$subjectid'");
        $lesson_query_result = mysqli_num_rows($lesson_query);
        if ($lesson_query_result > 0) {
            while ($row = mysqli_fetch_assoc($lesson_query)) {
                $lesson_id = $row['lesson_id'];

                //delete the pdf and video first...........
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

                //now delete the lesson under this course........
                $_lessonquery = mysqli_query($con, "DELETE FROM `lesson` WHERE `lesson_id`=$lesson_id");
            }
        }
        // lastly delete the subject................................
        $subject_query_delete = mysqli_query($con, "DELETE FROM `subject` WHERE `subject_id`=$subjectid");
        if ($subject_query_delete) {
            $_SESSION['ico'] = 'success';
            $_SESSION['title'] = 'The Course has been successfully removed.';
            header("location: ../index.php?page=_course&status=success");
        } else {
            $_SESSION['ico'] = 'error';
            $_SESSION['title'] = "Deletion Failed.";
            header("location: ../index.php?page=_course&status=failed");
        }
    } else {
        $_SESSION['ico'] = 'error';
        $_SESSION['title'] = "The system is unable to detect the Course's ID";
        header("location: ../index.php?page=_course&status=failed");
    }
} else {
    $_SESSION['ico'] = 'error';
    $_SESSION['title'] = 'No input detected';
    header("location: ../index.php?page=_course&status=failed");
}

?>

<?php
// include('../../config/db_connect.php'); // the database connection...........
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     if(isset($_POST['id'])){
//         $subjectid = $_POST['id'];

//         $_sqlquery = mysqli_query($con,"DELETE FROM `subject` WHERE `subject_id` = '$subjectid'");

//         $_SESSION['ico'] = 'success';
//         $_SESSION['title'] = 'The Course has been successfully removed.';
//         header("location: ../index.php?page=_course&status=success");
//     }else{
//         $_SESSION['ico'] = 'error';
//         $_SESSION['title'] = "The system is unable to detect the Course's ID";
//         header("location: ../index.php?page=_course&status=failed");
//     }  
// }else{
//     $_SESSION['ico'] = 'error';
//     $_SESSION['title'] = 'No input detected';
//     header("location: ../index.php?page=_course&status=failed");
// }

?>