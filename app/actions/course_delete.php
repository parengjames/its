<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id'])){
        $subjectid = $_POST['id'];

        //query the lesson table to get the lesson_id connected to this subject.......
        $lesson_query = mysqli_query($con, "SELECT * FROM `lesson` WHERE `subject_id` = '$subjectid'");
        $lesson_query_result = mysqli_num_rows($lesson_query);
        if($lesson_query_result > 0){
            while($row = mysqli_fetch_assoc($lesson_query)){
                $lesson_id = $row['lesson_id'];

                //delete the pdf and video first...........
            }
        }else{
            $_sqlquery = mysqli_query($con,"DELETE FROM `subject` WHERE `subject_id` = '$subjectid'");
        }

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