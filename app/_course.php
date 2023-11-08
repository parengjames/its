<style>
    #btn {
        font-size: 14px;
        font-weight: bold;
        border: 1px solid #4B49AC;
        border-radius: 8px;
        padding: 10px 10px;
    }

    ul {
        list-style-type: none;
    }

    ul li {
        float: inline-start;
    }

    #icon_button i {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        font-size: 15px;
    }
</style>

<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div style="margin-bottom: -30px;" class="row">
                            <div class="col-12 col-xl-8 mb-xl-0">
                                <h3 class="font-weight-bold">Manage Course</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: -20px;" class="row">
        <div class="col-md-6  grid-margin stretch-card">
            <div style="height: 390px;" class="card">
                <div class="card-body">
                    <?php
                    if (isset($_GET['direct'])) {
                        $_subject_id = $_GET['direct'];
                        $sql_query = mysqli_query($con, "SELECT * FROM subject WHERE subject_id='$_subject_id'");
                        $resultquery = mysqli_num_rows($sql_query);
                        if ($resultquery > 0) {
                            while ($rows = mysqli_fetch_assoc($sql_query)) {
                    ?>
                                <h4 class="card-title">Update course form</h4>
                                <form action="actions/course_edit.php" method="POST" class="forms-sample">
                                    <input value="<?php echo $_subject_id ?>" type="hidden" class="form-control" name="id" id="id">
                                    <div class="form-group">
                                        <label for="coursename">Course name</label>
                                        <input value="<?php echo $rows['subject_name'] ?>" type="text" class="form-control" name="coursename" id="coursename" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea style="resize: vertical;" class="form-control" name="description" id="description" rows="3"><?php echo $rows['subject_about'] ?></textarea>
                                    </div>
                                    <button style="border-radius: 5px;" type="submit" name="submit" class="btn btn-primary mr-3">Update</button>
                                    <a href="index.php?page=_course" style="border-radius: 5px;" type="submit" name="clear" class="btn btn-light">Back</a>
                                </form>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <h4 class="card-title">Add course form</h4>
                        <form action="actions/course_add.php" method="POST" class="forms-sample">
                            <div class="form-group">
                                <label for="coursename">Course name</label>
                                <input type="text" class="form-control" name="coursename" id="coursename" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea style="resize: vertical;" class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                            <button style="border-radius: 5px;" type="submit" name="submit" class="btn btn-primary mr-3">Save</button>
                            <button style="border-radius: 5px;" type="submit" name="clear" class="btn btn-light">Clear</button>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Course List</h4>
                    <div class="table-responsive">
                        <table class="table table-hover" id="course_table">
                            <thead>
                                <tr>
                                    <th style="width: 10px;">No.</th>
                                    <th style="width: 50px;">Course name</th>
                                    <th style="width: 5px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $_sqlquery = mysqli_query($con, "SELECT * FROM `subject`");
                                $_result = mysqli_num_rows($_sqlquery);
                                $num = 1;
                                if ($_result > 0) {
                                    while ($row = mysqli_fetch_assoc($_sqlquery)) {
                                        $course_num = $row['subject_id'];
                                ?>
                                        <tr>
                                            <td><?php echo $num++ ?></td>
                                            <td><?php echo $row['subject_name'] ?></td>
                                            <td>
                                                <a href="index.php?page=_lessons_add&course=<?php echo $course_num ?>"><button type="button" id="icon_button" title="Insert Lesson" class="btn btn-rounded btn-outline-info btn-icon">
                                                        <i class="ti-plus"></i>
                                                    </button></a>
                                                <a href="index.php?page=_course&direct=<?php echo $course_num ?>"><button type="button" id="icon_button" title="Update Info" class="btn btn-rounded btn-outline-info btn-icon">
                                                        <i class="ti-pencil-alt"></i>
                                                    </button></a>
                                                <button data-courseid="<?php echo $course_num ?>" data-toggle="modal" data-target="#course_delete_modal" id="icon_button" type="button" title="Delete student" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }else{
                                    ?>
                                    <tr>
                                        <td style="text-align: center;" colspan="3"></td>
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

<!-- Delete course Modal -->
<div class="modal fade" id="course_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete Course</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/course_delete.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="id" class="form-control" id="id" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="submit" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#course_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('courseid')

            var modal = $(this)
            modal.find('#id').val(id)
        })
    })
</script>

<script>
    $(document).ready(function() {
        new DataTable('#course_table')
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
            window.location = "index.php?page=_course";
        })
    </script>

<?php
    unset($_GET['status']);
    unset($_SESSION['ico']);
    unset($_SESSION['title']);
}
?>