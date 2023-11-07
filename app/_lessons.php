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
                                        <a id="btn" class="btn btn-light" title="Create account for student" href="lessons_add"><i style="font-size: 13px;" class="ti-write"></i> Add lesson</a>
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
                                    <th style="width: 300px;">
                                        Description
                                    </th>
                                    <th style="width: 150px;">
                                        Subject
                                    </th>
                                    <th style="width: 100px;">
                                        Status
                                    </th>
                                    <th style="width: 150px;">
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
                                            <td><?php echo $row['lesson_title'] ?></td>
                                            <td><textarea disabled style="word-wrap: break-word;width: 300px; border: none; resize: vertical;"><?php echo $row['lesson_description'] ?></textarea></td>
                                            <td><?php echo $row['subject_name'] ?></td>
                                            <td><?php echo $row['lesson_status'] ?></td>
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#user_update_modal" id="icon_button" title="Update Info" class="btn btn-rounded btn-outline-info btn-icon">
                                                    <i class="ti-pencil-alt"></i>
                                                </button>
                                                <button data-lessonid="<?php echo $lesson_id ?>" data-toggle="modal" data-target="#lesson_delete_modal" id="icon_button" type="button" title="Delete student" class="btn btn-rounded btn-outline-danger btn-icon">
                                                    <i class="ti-trash"></i>
                                                </button>
                                                <button id="icon_button" class="btn btn-rounded btn-icon btn-outline-secondary bg-white" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="ti-menu"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                                    <a style="border-bottom: 1px solid gray;" class="dropdown-item" href="#">Preview lesson</a>
                                                    <a style="border-bottom: 1px solid gray;" class="dropdown-item" href="#">PDF list</a>
                                                    <a class="dropdown-item" href="#">Video list</a>
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

<script>
    $(document).ready(function() {
        new DataTable('#lessonsTable')
    })
</script>