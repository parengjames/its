<div style="padding-top: 20px;" class="content-wrapper">
    <a id="up" href="activities"><button style="margin-bottom: 20px;font-size: 15px;" type="button" class="btn btn-outline-dark btn-sm">
            <i class="ti-arrow-left"></i> Back
        </button></a>
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div id="uploadcontent" class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h3 style="font-weight: bold;font-style: italic;">Activity:
                                    <?php
                                    if (isset($_GET['activity'])) {
                                        $actID = $_GET['activity'];
                                        $_SESSION['activity_id'] = $actID;
                                        $query = mysqli_query($con, "SELECT * FROM activity WHERE activity_id= '$actID'");
                                        $query_result = mysqli_num_rows($query);
                                        if ($query_result > 0) {
                                            while ($row = mysqli_fetch_assoc($query)) {
                                                echo " " . $row['activity_name'];
                                            }
                                        } else {
                                            echo "";
                                        }
                                    }
                                    ?>
                                </h3>
                                <?php
                                if (isset($_GET['view'])) {
                                    $item_id_query = $_GET['view'];
                                    $sql = mysqli_query($con, "SELECT * FROM `quiz` WHERE quiz_id = $item_id_query");
                                    $sqlresult = mysqli_num_rows($sql);
                                    if ($sqlresult > 0) {
                                        while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                            <form action="actions/activity_backend.php" method="POST" enctype="multipart/form-data">
                                                <h4 style="color: #06BBCC;" class="card-title">View | Update questions</h4>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" value="<?php echo $item_id_query ?>" name="item_id" id="item_id">
                                                    <input type="hidden" class="form-control" value="<?php echo $row['activity_id'] ?>" name="activity_id" id="activity_id">
                                                    <label for="title">Number control</label>
                                                    <input type="number" class="form-control" value="<?php echo $row['quiz_number'] ?>" name="number" id="number" autocomplete="off" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="lesson_materials">Question</label>
                                                    <textarea id="quiz_question" name="quiz_question" class="form-group"><?php echo $row['quiz_question'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Question choices:</label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" value="<?php echo $row['quiz_ch1'] ?>" name="choice_1" id="choice_1" placeholder="Choice A" autocomplete="off" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" value="<?php echo $row['quiz_ch2'] ?>" name="choice_2" id="choice_2" placeholder="Choice B" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: 15px;" class="row">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" value="<?php echo $row['quiz_ch3'] ?>" name="choice_3" id="choice_3" placeholder="Choice C" autocomplete="off" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" value="<?php echo $row['quiz_ch4'] ?>" name="choice_4" id="choice_4" placeholder="Choice D" autocomplete="off" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Answer key</label>
                                                    <input type="text" class="form-control" value="<?php echo $row['answer_key'] ?>" name="answerkey" id="answerkey" placeholder="Enter the correct answer" autocomplete="off" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Question Hints:</label>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" value="<?php echo $row['hint1'] ?>" name="hint1" id="hint1" placeholder="Hint 1" autocomplete="off">
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <input type="file" name="hint2_new" id="hint2_new   " class="file-upload-default">
                                                                <div class="input-group col-xs-12">
                                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload new image here">
                                                                    <span class="input-group-append">
                                                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="margin-top: -5px;" class="row">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" value="<?php echo $row['hint3'] ?>" name="hint3" id="hint3" placeholder="Hint 3" autocomplete="off">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="">Current Image for Hint 2</label><br>
                                                            <img style="border: 1px solid black;height: 150px;" src="<?php echo 'actions/hint_pictures/'.$row['hint2']?>" alt="Hint">
                                                            <input type="hidden" class="form-control" value="<?php echo $row['hint2'] ?>" name="hint2_unchanged" id="hint2_unchanged" autocomplete="off">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group mt-3">
                                                    <button type="submit" name="update_question" class="btn btn-primary mr-2">Update</button>
                                                    <a href="index.php?page=_add_quiz&activity=<?php echo $_SESSION['activity_id'] ?>#tab"><button type="button" name="reset" class="btn btn-light">Close</button></a>
                                                </div>
                                            </form>
                                    <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <form action="actions/activity_backend.php" method="POST" enctype="multipart/form-data">
                                        <h4 style="color: #06BBCC;" class="card-title">Add questions</h4>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" value="<?php echo $_GET['activity'] ?>" name="activity_id" id="activity_id">
                                            <label for="title">Number control</label>
                                            <input type="number" class="form-control" name="number" id="number" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lesson_materials">Question</label>
                                            <textarea id="quiz_question" name="quiz_question" class="form-group"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Question choices:</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="choice_1" id="choice_1" placeholder="Choice A" autocomplete="off" required>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="choice_2" id="choice_2" placeholder="Choice B" autocomplete="off" required>
                                                </div>
                                            </div>
                                            <div style="margin-top: 15px;" class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="choice_3" id="choice_3" placeholder="Choice C" autocomplete="off" required>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="choice_4" id="choice_4" placeholder="Choice D" autocomplete="off" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Answer key</label>
                                            <input type="text" class="form-control" name="answerkey" id="answerkey" placeholder="Enter the correct answer" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Question Hints:</label>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="hint1" id="hint1" placeholder="Hint 1" autocomplete="off" required>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="file" name="hint2" id="hint2" class="file-upload-default" required>
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Hint 2">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: -5px;" class="row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="hint3" id="hint3" placeholder="Hint 3" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" name="add_question" class="btn btn-primary mr-2">Submit</button>
                                            <a href="index.php?page=_add_quiz&activity=<?php echo $_SESSION['activity_id'] ?>#up"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                                        </div>
                                    </form>
                                <?php
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="tab" class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List of questions:</h4>
                    <br>
                    <div style="margin-top: -15px;" class="table-responsive">
                        <table style="padding-left: 80px;padding-right: 80px;" class="table table-hover" id="questionTable">
                            <thead>
                                <tr>
                                    <th>
                                        Question number
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $act = $_SESSION['activity_id'];
                                $sqlfetch = mysqli_query($con, "SELECT * FROM `quiz` WHERE activity_id = $act
                                ORDER BY quiz_number ASC");
                                $fetchresult = mysqli_num_rows($sqlfetch);
                                if ($fetchresult > 0) {
                                    while ($row = mysqli_fetch_assoc($sqlfetch)) {
                                        $quiz_id = $row['quiz_id'];
                                        $number_question = $row['quiz_number'];
                                        $question = $row['quiz_question'];
                                        $choice1 = $row['quiz_ch1'];
                                        $choice2 = $row['quiz_ch2'];
                                        $choice3 = $row['quiz_ch3'];
                                        $choice4 = $row['quiz_ch4'];
                                        $answer_key = $row['answer_key'];
                                        $hint1 = $row['hint1'];
                                        $hint2 = $row['hint2'];
                                        $hint3 = $row['hint3'];
                                        $activity = $row['activity_id'];

                                ?>
                                        <tr>
                                            <td>Question #<?php echo $number_question ?></td>
                                            <td>
                                                <a href="index.php?page=_add_quiz&activity=<?php echo $_SESSION['activity_id'] ?>&view=<?php echo $quiz_id ?>#up">
                                                    <button id="icon_button" type="button" title="Edit & View" class="btn btn-rounded btn-outline-info btn-icon">
                                                        <i class="ti-eye"></i>
                                                    </button>
                                                </a>
                                                <button data-id="<?php echo $quiz_id; ?>" data-hint2="<?php echo $hint2 ?>" data-toggle="modal" data-target="#question_delete_modal" id="icon_button" type="button" title="Delete Question" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="2">No Questions found</td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete pdf Modal -->
<div class="modal fade" id="question_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete Question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/activity_backend.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="que-id" class="form-control" id="id" aria-hidden="true">
                    <input type="hidden" name="hint_2" class="form-control" id="hnt2" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="delete_question" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- transfer data to modal -->
<script>
    $(document).ready(function() {
        $('#question_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id')
            var hint2name = button.data('hint2')

            var modal = $(this)
            modal.find('#id').val(id)
            modal.find('#hnt2').val(hint2name)
        })
    })
</script>

<?php
if (isset($_GET['status'])) {
?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: "<?php echo $_SESSION['ico'] ?>",
            title: "<?php echo $_SESSION['text'] ?>"
        }).then(function() {
            window.location = "index.php?page=_add_quiz&activity=<?php echo $_SESSION['activity_id'] ?>";
        })
    </script>

<?php
    unset($_GET['status']);
    unset($_SESSION['ico']);
    unset($_SESSION['text']);
}
?>

<!-- Rich text editor scripts  -->
<script>
    var editor1 = new RichTextEditor("#quiz_question");
    //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
</script>

<script>
    (function($) {
        'use strict';
        $(function() {
            $('.file-upload-browse').on('click', function() {
                var file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });
            $('.file-upload-default').on('change', function() {
                $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
            });
        });
    })(jQuery);
</script>

<script>
    $(document).ready(function() {
        new DataTable('#questionTable')
    })
</script>