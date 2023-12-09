<?php
include("_header.php");
include("../config/db_connect.php");
?>

<style>
    .card {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .card .card-body {
        padding-left: 50px;
    }

    .backdrop {
        padding: 40px 150px 10px 150px;
    }
</style>

<?php
$user_id = $_SESSION['user_id'];
$activity_id = $_SESSION['acti_id'];
$quiz_taken = $_SESSION['quiz_take'];
$total_question = $_SESSION['total_items'];

//
$_SESSION['activity_id_from_results'] = $activity_id;
?>


<div class="backdrop">
    <div class="tabform col-lg-12 grid-margin stretch-card">
        <div id="card-header" class="card">
            <div class="card-body bod">
                <h3 style="font-weight: bold;">📄Your quiz result 🖊</h3>
                <h5>Detailed result of your quiz.</h5>
            </div>
        </div>
    </div>

    <div style="margin-top: -20px;" class="tabform col-lg-12 grid-margin stretch-card">
        <div id="card-header" class="card">
            <div class="card-body bod">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <table class="table" id="table">
                            <tbody>
                                <tr>
                                    <td>Number of attempt: </td>
                                    <td><?php echo $quiz_taken ?></td>
                                </tr>
                                <tr>
                                    <td>Total Questions: </td>
                                    <td><?php echo $total_question ?></td>
                                </tr>
                                <tr>
                                    <td style="color: red;font-weight: bold;">Total Mistakes (All questions): </td>
                                    <?php
                                    $mistakequery = mysqli_query($con, "SELECT COUNT(mistakes) as total_mistakes FROM `quiz_mistakes` 
                                        WHERE `user_id`=$user_id AND `activity_id`=$activity_id AND `quiz_attempt`= $quiz_taken");
                                    $result = mysqli_num_rows($mistakequery);
                                    if ($result > 0) {
                                        while ($row = mysqli_fetch_assoc($mistakequery)) {
                                            $total_mistakes = $row['total_mistakes'];
                                        }
                                    }
                                    ?>
                                    <td style="color: orange;font-weight: bold;"><?php echo $total_mistakes ?></td>
                                </tr>
                                <tr>
                                    <td style="color: orange;font-weight: bold;">number of hint used: </td>
                                    <?php
                                    $hintquery = mysqli_query($con, "SELECT SUM(use_hint) as total_hints FROM `quiz_correct` 
                                        WHERE `user_id`=$user_id AND `activity_id`=$activity_id AND `quiz_attempt`= $quiz_taken");
                                    $result = mysqli_num_rows($hintquery);
                                    if ($result > 0) {
                                        while ($row = mysqli_fetch_assoc($hintquery)) {
                                            $total_hint = $row['total_hints'];
                                        }
                                    }
                                    ?>
                                    <td style="color: orange;font-weight: bold;"><?php echo $total_hint ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 25px;font-weight: bold;">Your Total Score: </td>
                                    <?php
                                    $pointsquery = mysqli_query($con, "SELECT SUM(points) as total_points FROM `quiz_correct` 
                                        WHERE `user_id`=$user_id AND `activity_id`=$activity_id AND `quiz_attempt`= $quiz_taken");
                                    $result = mysqli_num_rows($pointsquery);
                                    if ($result > 0) {
                                        while ($row = mysqli_fetch_assoc($pointsquery)) {
                                            $total_points = $row['total_points'];
                                        }
                                    }
                                    ?>
                                    <td style="font-size: 25px;font-weight: bold;"><?php echo $total_points ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="text-align: center;" class="col-md-6 col-sm-12">
                        <?php
                        $passing = $_SESSION['passing_grade'];
                        $course_id = $_SESSION['course_id'];
                        $is_passed;
                        if ($total_points >= $passing) {
                            $is_passed = 1;
                        ?>
                            <h2 style="color: green;font-weight: bold;">Congratulations</h2><br>
                            <img style="height: 100px;" src="images/check-gif.gif" alt="check"><br><br>
                            <h5>You have passed the quiz, you can now proceed to Lesson 2</h5><br>
                            <a class="btn btn-success" href="index.php?page=_home">Home</a>
                        <?php
                        } else {
                            $is_passed = 0;
                        ?>
                            <h2 style="color: red;font-weight: bold;">Unfortunately</h2><br>
                            <img style="height: 100px;" src="images/x-gif.gif" alt="x"><br><br>
                            <h5>You did not passed the quiz</h5><br>
                            <a class="btn btn-light" href="index.php?page=_lesson_student&course=<?php echo $course_id ?>">Retake</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
if (isset($_GET['saveresult'])) {
    $lesson = $_SESSION['from_lesson'];
    $save = mysqli_query($con, "INSERT INTO `quiz_results`(`user_id`, `activity_id`,`lesson_id`, `total_mistakes`, `total_hints`, `final_scores`, `is_passed`, `quiz_attempt`) 
        VALUES ('$user_id','$activity_id','$lesson','$total_mistakes','$total_hint','$total_points','$is_passed','$quiz_taken')");
}
?>

<!-- script all script -->
<?php include("_scripts.php") ?>

<?php
if (isset($_GET['saveresult'])) {
?>
    <script>
        swal({
            title: "You've finish the quiz",
            text: " See your result now.",
            icon: 'success',
            button: 'OK'
        }).then(function() {
            window.location = "_quiz_result.php";
        });
    </script>
<?php
}
?>