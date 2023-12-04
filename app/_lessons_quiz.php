<?php
include("_header.php");
include("../config/db_connect.php");
?>

<?php
if (isset($_SESSION['total_items'])) {
    $value = $_SESSION['total_items'];
} else {
    $value = 10;
}
// Assume $totalQuestions is the total number of questions in your quiz
$totalQuestions = $value;

if (isset($_GET['item'])) {
    $item_value = $_GET['item'];
} else if (isset($_GET['item']) == 1) {
    $item_value = 0;
} else {
    $item_value = 0;
}
// Assume $currentQuestion is the current question the user is on
$currentQuestion = $item_value;

// Calculate the percentage completion
$progressPercentage = ($currentQuestion / $totalQuestions) * 100;
?>

<style>
    .card {
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .card .card-body {
        padding-left: 50px;
    }

    .backdrop {
        padding: 40px 90px 10px 90px;
    }

    #hint {
        width: 70px;
        padding: 5px 0px 5px 0px;
        margin: 0px;
        border-radius: 7px;
        font-weight: bold;
        font-size: 16px;
        margin-top: -35px;
        margin-right: 150px;
    }

    #progress-bar {
        width: 100%;
        background-color: #ddd;
        border-radius: 5px;
        margin: 20px 0;
    }

    #progress {
        width: <?php echo $progressPercentage . "%"; ?>;
        height: 30px;
        background-color: #4caf50;
        border-radius: 5px;
        text-align: center;
        line-height: 30px;
        color: white;
    }

    .ch_button {
        padding-top: 8px;
        margin-bottom: -15px;
        background-color: white;
        border-radius: 5px;
        border: none;
    }

    .ch_button:hover {
        background-color: #F2F2F2;
    }
</style>

<?php
if (isset($_GET['take'])) {
    $quiz_taken =  $_GET['take'];
    $_SESSION['quiz_take'] = $quiz_taken;
}
?>

<?php
$item_number;
if (isset($_GET['item'])) {
    $item_number = $_GET['item'];
} else {
    $item_number = 1;
}
// Session variable of item number increment...........
$_SESSION['item_number'] = $item_number;
?>

<?php
$to_display_hint;
if (isset($_GET['show'])) {
    $to_display_hint = $_GET['show'];
} else {
    $to_display_hint = 1;
}
?>

<?php
$wrongs;
if (isset($_GET['wrong'])) {
    $wrongs = $_GET['wrong'];
} else {
    $wrongs = 0;
}
?>

<div class="backdrop">
    <div class="tabform col-lg-12 grid-margin stretch-card">
        <div id="card-header" class="card">
            <div class="card-body bod">
                <?php
                if (isset($_GET['activity'])) {
                    // session activity id............
                    $_SESSION['acti_id'] = $_GET['activity'];
                    // ....................................
                    $actid = $_GET['activity'];
                    $sql = mysqli_query($con, "SELECT * FROM `activity` WHERE activity_id = $actid");
                    $sqlresult = mysqli_num_rows($sql);
                    if ($sqlresult > 0) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            //session variabless.........
                            $_SESSION['total_items'] = $row['total_questions'];
                ?>
                            <h3 style="font-weight: bold;color: #06BBCC;"><?php echo $row['activity_name'] ?></h3>
                <?php
                        }
                    }
                }
                ?>
                <h4>Choose the correct answer. Goodluck! ✍️</h4>
                <button data-toggle="modal" data-target="#instruction" style="margin-top: -70px;padding: 8px;" class="btn btn-light float-right"><img style="height: 40px;" src="images/instruction.png" alt=""></button>
            </div>
        </div>
    </div>

    <div style="margin-top: -20px;" class="tabform col-lg-12 grid-margin stretch-card">
        <div id="card-header" class="card">
            <div class="card-body bod">
                <div class="header">
                    <div id="progress-bar">
                        <div id="progress"></div>
                    </div>
                    <h3 style="font-weight: bold;color: #06BBCC;">Question <?php echo $item_number ?> of 10</h3>
                    <?php
                    $attempted_wrong;
                    if (isset($_GET['wrong'])) {
                        $attempted_wrong = $_GET['wrong'];
                    } else {
                        $attempted_wrong = 0;
                    }
                    // Session variable of wrong - attempts..........
                    $_SESSION['wrong_attempts'] = $attempted_wrong;
                    ?>
                    <?php
                    if ($attempted_wrong >= 3) {
                    ?>
                        <button data-target="#hint_checkpoint" data-toggle="modal" id="hint" class="btn btn-warning float-right">
                            <i class="ti-light-bulb"></i>Hint
                        </button>
                    <?php
                    }
                    ?>
                </div>

                <table class="table">
                    <tbody>
                        <?php
                        $activityid = $_SESSION['acti_id'];
                        $sqlquery = mysqli_query($con, "SELECT * FROM `quiz` 
                            WHERE activity_id = $activityid AND quiz_number = $item_number");
                        $sqlresult = mysqli_num_rows($sqlquery);
                        if ($sqlresult > 0) {
                            while ($row = mysqli_fetch_assoc($sqlquery)) {
                                $hint1 = $row['hint1'];
                                $hint2 = $row['hint2'];
                                $hint3 = $row['hint3'];

                                $_SESSION['hint1'] = $row['hint1'];
                                $_SESSION['hint2'] = $row['hint2'];
                                $_SESSION['hint3'] = $row['hint3'];
                        ?>
                                <div style="border-bottom: 1px solid black;">
                                    <p style="font-size: 16px;margin-top: 20px;"><?php echo $row['quiz_question'] ?></p>
                                </div>
                                <form action="actions/quiz_backend.php" method="post">
                                    <input type="text" name="question_number" value="<?php echo $row['quiz_number'] ?>" hidden>
                                    <input type="text" name="question_key" value="<?php echo $row['answer_key'] ?>" hidden>
                                    <input type="text" name="activity_id" value="<?php echo $activityid ?>" hidden>
                                    <input type="text" name="hint_used" value="<?php if (isset($_GET['usehint'])) {
                                                                                    echo 1;
                                                                                } else {
                                                                                    echo 0;
                                                                                } ?>" hidden>
                                    <input type="text" name="show_hint" value="<?php echo $to_display_hint ?>" hidden>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <button class="ch_button" type="submit" value="<?php echo $row['quiz_ch1'] ?>" name="answer_input">
                                                <p>A. <?php echo $row['quiz_ch1'] ?></p>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <button class="ch_button" type="submit" value="<?php echo $row['quiz_ch2'] ?>" name="answer_input">
                                                <p>B. <?php echo $row['quiz_ch2'] ?></p>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <button class="ch_button" type="submit" value="<?php echo $row['quiz_ch3'] ?>" name="answer_input">
                                                <p>C. <?php echo $row['quiz_ch3'] ?></p>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <button class="ch_button" type="submit" value="<?php echo $row['quiz_ch4'] ?>" name="answer_input">
                                                <p>D. <?php echo $row['quiz_ch4'] ?></p>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Notification HINT modal confirmation -->
<div class="modal fade" id="hint_checkpoint" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="margin-top: 10%;" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">
                    Do you want to use the hint now?
                </h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                    <div class="col-6">
                        <button style="color: red;padding: 10px;" type="button" class="btn btn-light border-radius-100 btn-block confirmation-btn" data-dismiss="modal">
                            <i class="ti-close"></i>
                        </button>
                        NO
                    </div>
                    <div class="col-6">
                        <?php
                        if ($to_display_hint == 1) {
                        ?>
                            <button onclick="hint1()" style="color: #00FA9A;padding: 10px;" type="button" class="btn btn-light border-radius-100 btn-block confirmation-btn" data-dismiss="modal">
                                <i class="ti-check"></i>
                            </button>
                            YES
                        <?php
                        } else if ($to_display_hint == 2) {
                        ?>
                            <button data-toggle="modal" data-target="#hint2" style="color: #00FA9A;padding: 10px;" type="button" class="btn btn-light border-radius-100 btn-block confirmation-btn" data-dismiss="modal">
                                <i class="ti-check"></i>
                            </button>
                            YES
                        <?php
                        } else if ($to_display_hint == 3) {
                        ?>
                            <button onclick="hint3()" style="color: #00FA9A;padding: 10px;" type="button" class="btn btn-light border-radius-100 btn-block confirmation-btn" data-dismiss="modal">
                                <i class="ti-check"></i>
                            </button>
                            YES
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="instruction" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 80px;text-align: center;" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img style="margin-bottom: 20px;" src="images/instuction-gif.gif" alt="">
                <h4>Quiz instructions & score criteria</h4>
                <div style="text-align: left;">
                    <p>1. The student should choose the correct answer to proceed to the next question.</p>
                    <p>2. The student cannot go back to previous questions.</p>
                    <p>3. The student will have assistance in times of difficulties.</p>
                    <p>4. Hint will appear if the student get 3 consecutive mistakes</p>
                    <br>
                    <p>Score criteria:</p>
                    <p>1. correct answer in 1st attempt is 1 points</p>
                    <p>2. 1 attempt is wrong, it means you got 0 in 1 question.</p>
                </div>

                <br>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- script all script -->
<?php include("_scripts.php") ?>
<?php
if (isset($_GET['take'])) {
?>
    <script>
        setTimeout(function() {
            $("#instruction").modal('show');
        }, 1);
    </script>
<?php
}
?>

<!-- sweet alert notification -->
<?php
if (isset($_SESSION['show_sweetalert'])) {
?>
    <script>
        swal({
            title: "<?php echo $_SESSION['head_text'] ?>",
            text: "<?php echo  $_SESSION['body_text'] ?>",
            icon: "<?php echo $_SESSION['icon'] ?>",
        });
    </script>
<?php
}
unset($_SESSION['show_sweetalert']);
?>
<!-- 
Last item sweet alert -->
<?php
if (isset($_SESSION['show_sweetalert_last'])) {
?>
    <script>
        swal({
            title: "<?php echo $_SESSION['head_text'] ?>",
            text: "<?php echo  $_SESSION['body_text'] ?>",
            icon: "<?php echo $_SESSION['icon'] ?>",
            button: "See result"
        }).then(function() {
            window.location = "";
        })
    </script>
<?php
}
unset($_SESSION['show_sweetalert_last']);
?>

<!-- Correct answer pop notification -->
<?php
if (isset($_GET['gate'])) {
    if (isset($_SESSION['show_sweetalert_correct'])) {
?>
        <script>
            swal({
                title: "<?php echo $_SESSION['head_text'] ?>",
                text: "<?php echo  $_SESSION['body_text'] ?>",
                icon: "<?php echo $_SESSION['icon'] ?>",
                button: "Next"
            }).then(function() {
                window.location = "_lessons_quiz.php?activity=<?php echo $_SESSION['acti_id'] ?>&item=<?php echo $_SESSION['next_item'] ?>";
            })
        </script>
<?php
    }
}
?>

<!-- this is to show the hint 1.............. -->
<script>
    function hint1() {
        swal({
            title: '"<?php echo $_SESSION['hint1']; ?>"',
            icon: 'info',
            button: 'Close',
        }).then(function() {
            window.location = "_lessons_quiz.php?activity=<?php echo $_SESSION['acti_id'] ?>&item=<?php echo $_SESSION['item_number'] ?>&wrong=<?php echo $wrongs ?>&usehint=1&show=2";
        })
    }
</script>

<!-- this is to show the hint 2.............. -->
<div class="modal fade" id="hint2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <img style="width: 300px;margin-bottom: 20px;" src="actions/hint_pictures/<?php echo $_SESSION['hint2'] ?>" alt="hint">

                <div>
                    <a href="_lessons_quiz.php?activity=<?php echo $_SESSION['acti_id'] ?>&item=<?php echo $_SESSION['item_number'] ?>&wrong=<?php echo $wrongs ?>&usehint=1&show=3" class="btn btn-secondary" type="button">OK</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- this is to show the hint 3.............. -->
<script>
    function hint3() {
        swal({
            title: '"<?php echo $_SESSION['hint3']; ?>"',
            icon: 'info',
            button: 'Close',
        }).then(function() {
            window.location = "_lessons_quiz.php?activity=<?php echo $_SESSION['acti_id'] ?>&item=<?php echo $_SESSION['item_number'] ?>&wrong=<?php echo $wrongs ?>&usehint=1";
        })
    }
</script>