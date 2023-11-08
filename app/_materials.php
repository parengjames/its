<div class="content-wrapper">

    <div style="display: flex;" class="col-md-12 grid-margin">
        <a href="lessons"><button style="margin-bottom: 20px;font-size: 15px;" type="button" class="btn btn-outline-dark btn-sm">
                <i class="ti-arrow-left"></i> Back
            </button></a>
        <div class="col-12 col-xl-8 mt-2">
            <h3 class="font-weight-bold">Manage lesson materials</h3>
        </div>
    </div>

    <div style="margin-top: -30px;" class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Lesson content</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="materials_table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lesson name</th>
                                            <th>Date uploaded</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['lesson'])) {
                                            $number = 1;
                                            $_sqlquery = mysqli_query($con, "SELECT lesson.*, lesson_content.*
                                                FROM lesson_content
                                                LEFT JOIN lesson ON lesson_content.lesson_id = lesson.lesson_id
                                                WHERE lesson.lesson_id = '" . $_GET['lesson'] . "'");
                                            $result = mysqli_num_rows($_sqlquery);
                                            if ($result > 0) {
                                                while ($row = mysqli_fetch_assoc($_sqlquery)) {
                                                    $_SESSION['l_id'] = $row['lesson_id'];
                                        ?>
                                                    <tr>
                                                        <td><?php echo $number++ ?></td>
                                                        <td><?php echo $row['lesson_title'] ?></td>
                                                        <td><?php echo date('F d Y, h:i:s A', strtotime($row['content_date_added'])) ?></td>
                                                        <td>
                                                            <a href="index.php?page=_view_materials&content=<?php echo $row['content_id'] ?>">
                                                                <button id="icon_button" type="button" title="View PDF" class="btn btn-rounded btn-outline-info btn-icon">
                                                                    <i class="ti-eye"></i>
                                                                </button>
                                                            </a>
                                                            <button data-whatever="<?php echo $row['content_id'] ?>" data-toggle="modal" data-target="#content_delete_modal" id="icon_button" type="button" title="Delete PDF" class="btn btn-rounded btn-outline-danger btn-icon">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="4">NO DATA FOUND</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4">System cannot find the lesson ID</td>
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
    </div>

    <div style="margin-top: -10px;" class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">PDF files</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="materials_table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lesson name</th>
                                            <th>PDF name</th>
                                            <th>Date uploaded</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['lesson'])) {
                                            $number = 1;
                                            $_sqlquery = mysqli_query($con, "SELECT lesson.*, lesson_pdf.*
                                                FROM lesson_pdf
                                                LEFT JOIN lesson ON lesson_pdf.lesson_id = lesson.lesson_id
                                                WHERE lesson.lesson_id = '" . $_GET['lesson'] . "'");
                                            $result = mysqli_num_rows($_sqlquery);
                                            if ($result > 0) {
                                                while ($row = mysqli_fetch_assoc($_sqlquery)) {
                                                    $_SESSION['l_id'] = $row['lesson_id'];
                                        ?>
                                                    <tr>
                                                        <td><?php echo $number++ ?></td>
                                                        <td><?php echo $row['lesson_title'] ?></td>
                                                        <td><?php echo $row['pdf_content'] ?></td>
                                                        <td><?php echo date('F d Y, h:i:s A', strtotime($row['pdf_date_added'])) ?></td>
                                                        <td>
                                                            <a href="index.php?page=_view_materials&pdf=<?php echo $row['pdf_id'] ?>&lesson=<?php echo $row['lesson_title'] ?>">
                                                                <button id="icon_button" type="button" title="View PDF" class="btn btn-rounded btn-outline-info btn-icon">
                                                                    <i class="ti-eye"></i>
                                                                </button>
                                                            </a>
                                                            <button data-whatever="<?php echo $row['pdf_id'] ?>" data-toggle="modal" data-target="#pdf_delete_modal" id="icon_button" type="button" title="Delete PDF" class="btn btn-rounded btn-outline-danger btn-icon">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6">NO DATA FOUND</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">System cannot find the lesson ID</td>
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
    </div>


    <div style="margin-top: -10px;" class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Video files</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="video_table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lesson name</th>
                                            <th>Video name</th>
                                            <th>Date uploaded</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['lesson'])) {
                                            $number = 1;
                                            $_sqlquery = mysqli_query($con, "SELECT lesson.*, lesson_video.*
                                                FROM lesson_video
                                                LEFT JOIN lesson ON lesson_video.lesson_id = lesson.lesson_id
                                                WHERE lesson.lesson_id = '" . $_GET['lesson'] . "'");
                                            $result = mysqli_num_rows($_sqlquery);
                                            if ($result > 0) {
                                                while ($row = mysqli_fetch_assoc($_sqlquery)) {
                                                    $_SESSION['l_id'] = $row['lesson_id'];
                                        ?>
                                                    <tr>
                                                        <td><?php echo $number++ ?></td>
                                                        <td><?php echo $row['lesson_title'] ?></td>
                                                        <td><?php echo $row['playlist'] ?></td>
                                                        <td><?php echo date('F d Y, h:i:s A', strtotime($row['video_date_added'])) ?></td>
                                                        <td>
                                                            <a href="index.php?page=_view_materials&video=<?php echo $row['video_id'] ?>&lesson=<?php echo $row['lesson_title'] ?>&vid=<?php echo $row['playlist'] ?>">
                                                                <button id="icon_button" type="button" title="View video" class="btn btn-rounded btn-outline-info btn-icon">
                                                                    <i class="ti-eye"></i>
                                                                </button>
                                                            </a>
                                                            <button data-whatever="<?php echo $row['video_id'] ?>" data-toggle="modal" data-target="#video_delete_modal" id="icon_button" type="button" title="Delete video" class="btn btn-rounded btn-outline-danger btn-icon">
                                                                <i class="ti-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="6">NO DATA FOUND</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6">System cannot find the lesson ID</td>
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
    </div>
</div>

<!-- Delete content Modal -->
<div class="modal fade" id="content_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete Content file</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/materials_queue.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="content_id" class="form-control" id="id" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="delete_content" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- transfer data to modal -->
<script>
    $(document).ready(function() {
        $('#content_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('whatever')

            var modal = $(this)
            modal.find('#id').val(id)
        })
    })
</script>


<!-- Delete pdf Modal -->
<div class="modal fade" id="pdf_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete PDF file</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/materials_queue.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="id" class="form-control" id="id" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="delete_pdf" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- transfer data to modal -->
<script>
    $(document).ready(function() {
        $('#pdf_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('whatever')

            var modal = $(this)
            modal.find('#id').val(id)
        })
    })
</script>

<!-- Delete video Modal -->
<div class="modal fade" id="video_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Delete video file</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="actions/materials_queue.php" method="POST">
                <div class="modal-body">
                    <h6>Note that after delete, data will no longer available forever.</h6>
                    <input type="hidden" name="video_id" class="form-control" id="id" aria-hidden="true">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    <button type="submit" name="delete_video" value="approve" class="btn btn-warning">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- transfer data to modal video-->
<script>
    $(document).ready(function() {
        $('#video_delete_modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('whatever')

            var modal = $(this)
            modal.find('#id').val(id)
        })
    })
</script>

<!-- data table -->
<script>
    $(document).ready(function() {
        new DataTable('#materials_table')
    })
</script>

<script>
    $(document).ready(function() {
        new DataTable('#video_table')
    })
</script>

<!-- notification popup -->
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
            window.location = "index.php?page=_materials&lesson=<?php echo $_SESSION['l_id'] ?>";
        })
    </script>

<?php
    unset($_GET['status']);
    unset($_SESSION['ico']);
    unset($_SESSION['title']);
}
?>