<div class="content-wrapper">
    <div style="display: flex;" class="col-md-12 grid-margin">
        <a href="index.php?page=_materials&lesson=<?php echo $_SESSION['l_id'] ?>"><button style="margin-bottom: 20px;font-size: 15px;" type="button" class="btn btn-outline-dark btn-sm">
                <i class="ti-arrow-left"></i> Back
            </button></a>
        <div class="col-12 col-xl-8 mt-2">
            <?php
            if (isset($_GET['lesson']) && isset($_GET['vid'])) {
            ?>
                <h3 class="font-weight-bold"><?php echo $_GET['lesson'] . ': ' . $_GET['vid'] ?></h3>
            <?php
            }
            ?>
        </div>
    </div>
    <div style="margin-top: -30px;" class="col-md-12 grid-margin stretch-card">

        <?php
        if (isset($_GET['pdf']) && $_GET['pdf'] != "") {
            $_pdfid = $_GET['pdf'];
            $_sqlquery = mysqli_query($con, "SELECT * FROM `lesson_pdf` WHERE `pdf_id`='$_pdfid'");
            $_sqlresult = mysqli_num_rows($_sqlquery);
            if ($_sqlresult > 0) {
                while ($row = mysqli_fetch_assoc($_sqlquery)) {
                    $pdftodisplay = $row['pdf_location'];

        ?>
                    <div class="card">
                        <div class="card-body">
                            <iframe type="application/pdf" src="<?php echo "actions/" . $pdftodisplay ?>" width="100%" height="800px"></iframe>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "No data found on this ID.";
            }
            // display ni sa video.........
        } else if (isset($_GET['video']) && $_GET['video'] != "") {
            $_vid = $_GET['video'];
            $_sqlquery = mysqli_query($con, "SELECT * FROM `lesson_video` WHERE `video_id`='$_vid'");
            $_sqlresult = mysqli_num_rows($_sqlquery);
            if ($_sqlresult > 0) {
                while ($row = mysqli_fetch_assoc($_sqlquery)) {
                    $videotodisplay = $row['video_location'];
                ?>
                    <div style="align-items: center;justify-content: center;" class="card">
                        <div class="card-body">
                            <video src="<?php echo "actions/" . $videotodisplay ?>" width="1100px" controls></video>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "No data found on this ID.";
            }
            // display sa contentssss...........
        } else if (isset($_GET['content']) && $_GET['content'] != "") {

            $content_id = $_GET['content'];
            $_query = mysqli_query($con, "SELECT * FROM `lesson_content` WHERE `content_id`='$content_id'");
            $_result = mysqli_num_rows($_query);
            if ($_result > 0) {
                while ($row = mysqli_fetch_assoc($_query)) {
                    $content_body = $row['content_body'];
                    $num_order = $row['num_order'];
                ?>
                    <div id="update_content" class="card">
                        <div class="card-body">
                            <h4> Update the content</h4><br>
                            <form action="actions/lesson_backend.php" method="POST">
                                <?php
                                if (isset($_GET['stat'])) {
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['text'] ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                                } else if (isset($_GET['stats'])) {
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
                                <div class="form-group">
                                    <label for="title">Number order</label>
                                    <input type="hidden" value="<?php echo $content_id ?>" class="form-control" name="con_id" id="con_id">
                                    <input type="number" value="<?php echo $num_order ?>" class="form-control" name="number" id="number">
                                </div>
                                <div class="form-group">
                                    <textarea id="lesson_materials" name="lesson_materials" class="form-group">
                                            <p><?php echo $content_body ?></p>
                                        </textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="update_content" class="btn btn-primary mr-2">Update</button>
                                    <a href="index.php?page=_view_materials&content=<?php echo $content_id ?>"><button type="button" name="reset" class="btn btn-light">Reset</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div style="align-items: center;justify-content: center;" class="card">
            <div class="card-body">
                <h4> Preview:</h4><br>
                <div style="width: 1000px;padding: 20px;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                    <?php echo $content_body ?>
                </div>
            </div>
        </div>
    </div>
<?php
                }
            } else {
                echo "No data found on this ID.";
            }
        } else {
            echo "No id found.";
        }
?>

</div>

<!-- Rich text editor scripts  -->
<script>
    var editor1 = new RichTextEditor("#lesson_materials");
    //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
</script>