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

                    <?php
                }
            } else {
                echo "No data found on this ID.";
            }
                    ?>
                        </div>
                    </div>
                    <?php
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
                            </div>
    </div>
</div>