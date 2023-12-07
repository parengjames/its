<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Manage lessons</h3>
                            </div>
                            <div class="col-12 col-xl-4">
                                <div class="justify-content-end d-flex">
                                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                        <a id="btn" class="btn btn-light" title="Create account for student" href="lessons_add"><i style="font-size: 13px;" class="ti-write"></i> Add lesson and Materials</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: -15px;" class="table-responsive">
                        <table style="table-layout: fixed;border-collapse: collapse;" class="table table-hover" id="lessonsTable">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">
                                        No.
                                    </th>
                                    <th style="width: 190px;">
                                        Title
                                    </th>
                                    <th style="width: 250px;">
                                        Description
                                    </th>
                                    <th style="width: 200px;">
                                        Subject
                                    </th>
                                    <th style="width: 80px;">
                                        Status
                                    </th>
                                    <th style="width: 100px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- FETCHING DATA FROM DATABASE "USER DATA".................... -->
                                <?php
                                $sqlquery = mysqli_query($con, "SELECT lesson.lesson_id,lesson.lesson_title,lesson.lesson_description,lesson.lesson_status,subject.subject_name 
                                FROM lesson
                                LEFT JOIN subject ON lesson.subject_id = subject.subject_id");
                                $number = 1;
                                $sqlquery_result = mysqli_num_rows($sqlquery);
                                if ($sqlquery_result > 0) {
                                    while ($row = mysqli_fetch_assoc($sqlquery)) {
                                        $lesson_id = $row['lesson_id'];
                                ?>
                                        <tr style="resize: vertical;">
                                            <td><?php echo $number; ?></td>
                                            <td><textarea disabled style="word-wrap:break-word;width: 200px;border: none;resize: vertical;"><?php echo $row['lesson_title'] ?></textarea></td>
                                            <td><textarea disabled style="word-wrap: break-word;width: 300px; border: none; resize: vertical;"><?php echo $row['lesson_description'] ?></textarea></td>
                                            <td><textarea disabled style="word-wrap: break-word;width: 200px; border: none; resize: vertical;"><?php echo $row['subject_name'] ?></textarea></td>
                                            <td><?php echo $row['lesson_status'] ?></td>
                                            <td>
                                                <button data-id="<?php echo $lesson_id ?>" data-title="<?php echo $row['lesson_title'] ?>" data-desc="<?php echo $row['lesson_description'] ?>" data-subj="<?php echo $row['subject_name'] ?>" data-stats="<?php echo $row['lesson_status'] ?>" type="button" data-toggle="modal" data-target="#lesson_update_modal" id="icon_button" title="Update Info" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button data-lessonid="<?php echo $lesson_id ?>" data-toggle="modal" data-target="#lesson_delete_modal" id="icon_button" type="button" title="Delete student" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                                <button id="icon_button" class="btn btn-rounded btn-icon btn-outline-secondary bg-white" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="ti-menu"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                                    <a style="border-bottom: 1px solid gray;" class="dropdown-item" href="index.php?page=_materials&lesson=<?php echo $lesson_id; ?>">View materials</a>
                                                    <a style="border-bottom: 1px solid gray;" class="dropdown-item" href="index.php?page=_preview_lesson&lesson=<?php echo $lesson_id; ?>">Preview lesson</a>
                                                    <a class="dropdown-item" href="activities">Add Activity</a>
                                                </div>
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

<script src="actions/js/lesson_transaction.js"></script>

<!-- Delete Modal -->
<div class="modal fade" id="lesson_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete Lesson</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/lesson_backend.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="id" class="form-control" id="id" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="delete_lesson" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update lesson Modal -->
<div class="modal fade" id="lesson_update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 900px;margin-top: 10px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Update Lesson</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div style="padding: 0px 0px;margin-bottom: -30px;padding-bottom: -30px;" class="bod modal-body">
                <form action="actions/lesson_backend.php" method="POST">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" class="form-control" id="lesson-id" aria-hidden="true">
                                    <label for="">Lesson Title</label>
                                    <input type="text" class="form-control form-control-lg" id="lesson_title" name="lesson_title" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea style="resize: vertical;" class="form-control form-control-lg" name="lesson_desc" id="lesson_desc" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Subject</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input class="form-control" type="text" name="still_subject" id="subject_lesson">
                                        </div>
                                        <div class="col-8">
                                            <select class="form-control" name="changed_subject" id="subject_lesson">
                                                <option value="">Select to make change</option>
                                                <?php
                                                $_sqlquery = mysqli_query($con, "SELECT * FROM `subject`");
                                                $_result = mysqli_num_rows($_sqlquery);
                                                if ($_result > 0) {
                                                    while ($row = mysqli_fetch_assoc($_sqlquery)) {
                                                        $subject_id = $row['subject_id'];
                                                        $subject_name = $row['subject_name'];
                                                ?>
                                                        <option value="<?php echo $subject_id ?>"><?php echo $subject_name ?></option>
                                                <?php
                                                    }
                                                } else {
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Lesson status</label>
                                    <select class="form-control" name="lesson_status" id="status">
                                        <option></option>
                                        <option value="Partial">Partial</option>
                                        <option value="Available" selected>Available</option>
                                        <option value="Unavailable">Unavailable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="update_lesson" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#lesson_update_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            var id = button.data('id')
            var titles = button.data('title')
            var descript = button.data('desc')
            var subject = button.data('subj')
            var status = button.data('stats')

            var modal = $(this)
            modal.find('#lesson-id').val(id)
            modal.find('#lesson_title').val(titles)
            modal.find('#lesson_desc').val(descript)
            modal.find('#subject_lesson').val(subject)
            modal.find('#status').val(status)
        })
    })
</script>

<?php
if (isset($_GET['notif'])) {
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
            icon: "<?php echo $_SESSION['icon'] ?>",
            title: "<?php echo $_SESSION['content'] ?>"
        }).then(function() {
            window.location = "lessons";
        })
    </script>

<?php
    unset($_GET['notif']);
    unset($_SESSION['icon']);
    unset($_SESSION['content']);
}
?>

<script>
    $(document).ready(function() {
        new DataTable('#lessonsTable')
    })
</script>