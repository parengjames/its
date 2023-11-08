<style>
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 100px;
    }
</style>
<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="lessons"><button style="margin-bottom: 20px;font-size: 15px;" type="button" class="btn btn-outline-dark btn-sm">
                        <i class="ti-arrow-left"></i> Back</button></a>
                <h4 class="card-title">Insert new Lesson</h4>

                <form class="forms-sample" action="actions/lesson_backend.php" method="POST">
                    <?php if (isset($_GET['course'])) {
                        $sqlquery = mysqli_query($con, "SELECT * FROM `subject` WHERE `subject_id`='" . $_GET['course'] . "'");
                        $results = mysqli_num_rows($sqlquery);
                        if ($results > 0) {
                            while ($row = mysqli_fetch_assoc($sqlquery)) {
                                $course_name = $row['subject_name'];
                            }
                        }
                    ?>
                        <div class="form-group">
                            <label for="">Course ID</label>
                            <input type="hidden" value="<?php echo $_GET['course'] ?>" class="form-control" name="lesson_id" id="lesson_id">
                            <input type="text" disabled value="<?php echo $course_name ?>" class="form-control">
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="form-group">
                            <label>Course ID</label>
                            <select class="form-control" name="lesson_id" id="lesson_id">
                                <option></option>
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

                    <?php
                    } ?>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea style="resize: vertical;" type="text" class="form-control" name="description" id="desc" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Lesson status</label>
                        <select class="form-control" name="status" id="status">
                            <option></option>
                            <option value="Partial" selected>Partial</option>
                            <option value="Available">Available</option>
                            <option value="Unavailable">Unavailable</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="add_lesson" class="btn btn-primary mr-2">Submit</button>
                        <a href="lessons_add"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="uploadcontent" class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload lesson content</h4>
                <form class="forms-sample" action="actions/lesson_backend.php" method="POST">
                    <div class="form-group">
                        <label>Lesson id</label>
                        <select class="form-control" name="lesson_id" id="lesson_id">
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
                    <div class="form-group">
                        <label for="title">Number order</label>
                        <input type="number" class="form-control" name="number" id="number">
                    </div>
                    <div class="form-group">
                        <label for="lesson_materials">Lesson Content</label>
                        <textarea id="lesson_materials" name="lesson_materials" class="form-group"></textarea>
                    </div>
                    <?php
                    if (isset($_GET['deny'])) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    } else if (isset($_GET['give'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group mt-3">
                        <button type="submit" name="add_content" class="btn btn-primary mr-2">Submit</button>
                        <a href="lessons_add#uploadcontent"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="uploadpdf" class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Insert PDF file</h4>
                <form class="forms-sample" action="actions/lesson_backend.php" method="POST" enctype="multipart/form-data">
                    <?php
                    if (isset($_GET['notif'])) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    } else if (isset($_GET['note'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Lesson id</label>
                                <select class="form-control" name="lesson_id" id="lesson_id">
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
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="pdf_upload" id="pdf_upload" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload PDF">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="add_pdf" class="btn btn-primary mr-2">Submit</button>
                        <a href="lessons_add#uploadpdf"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="uploadvideo" class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Insert Video file</h4>
                <form class="forms-sample" action="actions/lesson_backend.php" method="POST" enctype="multipart/form-data">

                    <?php
                    if (isset($_GET['error'])) {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    } else if (isset($_GET['good'])) {
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Lesson id</label>
                                <select class="form-control" name="lesson_id" id="lesson_id">
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
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Video upload</label>
                                <input type="file" name="video_upload" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload video">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" name="add_video" class="btn btn-primary mr-2">Submit</button>
                        <a href="lessons_add#uploadvideo"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Rich text editor scripts  -->
<script>
    var editor1 = new RichTextEditor("#lesson_materials");
    //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
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
            window.location = "lessons_add";
        })
    </script>

<?php
    unset($_GET['status']);
    unset($_SESSION['ico']);
    unset($_SESSION['title']);
}
?>


<!-- <script>
    ClassicEditor
        .create(document.querySelector('#lesson_materials'), {
            ckfinder:{
                uploadUrl: 'app/actions/lesson_file.php'
            }
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script> -->

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