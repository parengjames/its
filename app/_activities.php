<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Manage Activities</h3>
                            </div>
                            <div class="col-12 col-xl-4">
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <a id="btn" data-toggle="modal" data-target="#add_activity_modal" type="button" class="btn btn-light" title="Create account for student">
                                            <i style="font-size: 13px;" class="ti-write"></i> Add activity
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: -15px;" class="table-responsive">
                        <table style="table-layout: fixed;border-collapse: collapse;" class="table table-hover" id="activityTable">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">
                                        No.
                                    </th>
                                    <th style="width: 150px;">
                                        Activity
                                    </th>
                                    <th style="width: 200px;">
                                        From Lesson
                                    </th>
                                    <th style="width: 50px;">
                                        Questions
                                    </th>
                                    <th style="width: 50px;">
                                        Points
                                    </th>
                                    <th style="width: 50px;">
                                        Average
                                    </th>
                                    <th style="width: 100px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- FETCHING DATA FROM DATABASE "USER DATA".................... -->
                                <?php
                                $sqlquery = mysqli_query($con, "SELECT lesson.*,activity.*
                                FROM activity
                                LEFT JOIN lesson ON activity.lesson_id = lesson.lesson_id");
                                $number = 1;
                                $sqlquery_result = mysqli_num_rows($sqlquery);
                                if ($sqlquery_result > 0) {
                                    while ($row = mysqli_fetch_assoc($sqlquery)) {
                                        $act_id = $row['activity_id'];
                                        $_SESSION['activity'] = $act_id;
                                ?>
                                        <tr style="resize: vertical;">
                                            <td><?php echo $number; ?></td>
                                            <td><?php echo $row['activity_name'] ?></td>
                                            <td><?php echo $row['lesson_title'] ?></td>
                                            <td><?php echo $row['total_questions'] ?></td>
                                            <td><?php echo $row['total_points'] ?></td>
                                            <td><?php echo $row['passing_grade'] ?></td>
                                            <td>
                                                <a href="index.php?page=_add_quiz&activity=<?php echo $act_id ?>"><button type="button" id="icon_button" title="Insert Activity" class="btn btn-rounded btn-outline-info btn-icon">
                                                        <i class="ti-plus"></i>
                                                    </button></a>
                                                <button data-activityid="<?php echo $act_id ?>" data-title="<?php echo $row['activity_name'] ?>" data-lessonid="<?php echo $row['lesson_title'] ?>" data-actquestion="<?php echo $row['total_questions'] ?>" data-points="<?php echo $row['total_points'] ?>" data-pass="<?php echo $row['passing_grade'] ?>" type="button" data-toggle="modal" data-target="#edit_activity_modal" id="icon_button" title="Update Info" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button data-actid="<?php echo $act_id ?>" data-toggle="modal" data-target="#activity_delete_modal" id="icon_button" type="button" title="Delete student" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td style="text-align: center;" colspan="6">NO DATA FOUND</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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

<!-- Add activity modal............................. -->
<div class="modal fade" id="add_activity_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 500px;margin-top: 10px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Add activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div style="padding: 0px 0px;margin-bottom: -30px;padding-bottom: -30px;" class="bod modal-body">
                <form action="actions/activity_backend.php" method="POST">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div style="margin-bottom: 5px;margin-top: -5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Activity name</label>
                                    <input type="text" class="form-control form-control-lg" id="activity_name" name="activity_name" autocomplete="off" required>
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">From Lesson</label>
                                    <select class="form-control" name="lesson_id" id="lesson_id" required>
                                        <option value=""></option>
                                        <?php
                                        $_query = mysqli_query($con, "SELECT * FROM `lesson`");
                                        $_result = mysqli_num_rows($_query);
                                        if ($_result > 0) {
                                            while ($row = mysqli_fetch_assoc($_query)) {
                                                $lesson_title = $row['lesson_title'];
                                                $lesson_id = $row['lesson_id'];
                                        ?>
                                                <option value="<?php echo $lesson_id ?>"><?php echo $lesson_title; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Total questions</label>
                                    <input type="number" class="form-control form-control-lg" id="total_question" name="total_question" required autocomplete="off">
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Total Points</label>
                                    <input type="number" class="form-control form-control-lg" id="total_points" name="total_points" required autocomplete="off">
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Passing Grade</label>
                                    <input type="number" class="form-control form-control-lg" id="pass_grade" name="pass_grade" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="add_activity" class="btn btn-success">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit activity modal.............................................. -->
<div class="modal fade" id="edit_activity_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 600px;margin-top: 10px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Edit activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div style="padding: 0px 0px;margin-bottom: -30px;padding-bottom: -30px;" class="bod modal-body">
                <form action="actions/activity_backend.php" method="POST">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div style="margin-bottom: 5px;margin-top: -5px;" class="form-group">
                                    <input type="hidden" id="activity_id" name="activity_id">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Activity name</label>
                                    <input type="text" class="form-control form-control-lg" id="activitytitle" name="activity_name" autocomplete="off" required>
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">From Lesson</label>
                                    <div class="row">
                                        <div style="padding-left: 15px;padding-right: 0px;" class="col-5">
                                            <input class="form-control" type="text" name="still_lesson" id="still_lesson">
                                        </div>
                                        <div style="padding-left: 2px;padding-right: 15px;" class="col-7">
                                            <select class="form-control" name="changed_lesson" id="changed_lesson">
                                                <option value="">-- select here to changes --</option>
                                                <?php
                                                $_query = mysqli_query($con, "SELECT * FROM `lesson`");
                                                $_result = mysqli_num_rows($_query);
                                                if ($_result > 0) {
                                                    while ($row = mysqli_fetch_assoc($_query)) {
                                                        $lesson_title = $row['lesson_title'];
                                                        $lesson_id = $row['lesson_id'];
                                                ?>
                                                        <option value="<?php echo $lesson_id ?>"><?php echo $lesson_title; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Total questions</label>
                                    <input type="number" class="form-control form-control-lg" id="total_question" name="total_question" required autocomplete="off">
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Total Points</label>
                                    <input type="number" class="form-control form-control-lg" id="total_points" name="total_points" required autocomplete="off">
                                </div>
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label style="padding-bottom: 0px;margin-bottom: 0px;" for="">Passing Grade</label>
                                    <input type="number" class="form-control form-control-lg" id="pass_grade" name="pass_grade" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit_activity" class="btn btn-success">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="activity_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/activity_backend.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="act_id" class="form-control" id="id" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="delete_activity" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#activity_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('actid')

            var modal = $(this)
            modal.find('#id').val(id)
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#edit_activity_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            var id = button.data('activityid')
            var name = button.data('title')
            var lesson1 = button.data('lessonid')
            var question1 = button.data('actquestion')
            var points = button.data('points')
            var passing = button.data('pass')

            var modal = $(this)
            modal.find('#activity_id').val(id)
            modal.find('#activitytitle').val(name)
            modal.find('#still_lesson').val(lesson1)
            modal.find('#total_question').val(question1)
            modal.find('#total_points').val(points)
            modal.find("#pass_grade").val(passing)
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
            title: "<?php echo $_SESSION['title'] ?>"
        }).then(function() {
            window.location = "index.php?page=_activities";
        })
    </script>

<?php
    unset($_GET['status']);
    unset($_SESSION['ico']);
    unset($_SESSION['title']);
}
?>

<script>
    $(document).ready(function() {
        new DataTable('#activityTable')
    })
</script>