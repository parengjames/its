<div style="padding-top: 20px;" class="content-wrapper">
    <div style="display: flex;margin-bottom: -10px;" class="col-md-12 grid-margin">
        <a href="lessons"><button style="margin-bottom: 20px;font-size: 15px;" type="button" class="btn btn-outline-dark btn-sm">
                <i class="ti-arrow-left"></i> Back
            </button></a>
    </div>
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div style="margin-bottom: -30px;" class="row">
                            <div class="col-12 col-xl-8 mb-xl-0">
                                <?php
                                if (isset($_GET['lesson'])) {
                                    $lesson_id = $_GET['lesson'];

                                    $_sql = mysqli_query($con, "SELECT * FROM `lesson` WHERE `lesson_id`='$lesson_id'");
                                    $_result = mysqli_num_rows($_sql);
                                    if ($_result > 0) {
                                        while ($row = mysqli_fetch_assoc($_sql)) {
                                            $title = $row['lesson_title'];
                                            $description = $row['lesson_description'];
                                        }
                                ?>
                                        <h3 style="color: #06BBCC;" class="font-weight-bold">Title: <?php echo $title ?></h3>
                                        <p><?php echo $description ?></p>
                                    <?php
                                    } else {
                                    ?>
                                        <h3 style="color: #06BBCC;" class="font-weight-bold">Title: ............</h3>
                                        <p>no data found.....</p>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div style="margin-top: -20px;padding-right: 5px;" class="tabform col-lg-9 grid-margin stretch-card">
            <div style="padding: 15px 10px;" class="card">
                <div class="card-body">
                    <?php
                    if (isset($_GET['lesson'])) {
                        $lesson_id = $_GET['lesson'];
                        $_sql = mysqli_query($con, "SELECT * FROM `lesson_content` WHERE lesson_id = '$lesson_id'
                            ORDER BY num_order ASC");
                        $_result = mysqli_num_rows($_sql);
                        if ($_result > 0) {
                            while ($row = mysqli_fetch_assoc($_sql)) {
                                $content_to_display = $row['content_body'];
                                //display.......
                                echo $content_to_display;
                                echo "<br>";
                            }
                        }
                    } else {
                        echo "no data found";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div style="margin-top: -20px;padding-left: 5px;height: 700px;" class="tabform col-lg-3 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5>Materials:</h5>
                    <nav style="min-height: 0px;width: auto" class="sidebar sidebar-offcanvas" id="sidebar">
                        <ul class="nav">
                            <li class="nav-item">
                                <a style="border: 1px solid gray;" class="nav-link" data-toggle="collapse" href="#pdf" aria-expanded="false" aria-controls="form-elements">
                                    <span class="menu-title">PDF Files</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="pdf">
                                    <div class="form-group">
                                        <table style="background-color: white;" class="table-hover" style="width: 219px;">
                                            <tbody>
                                                <?php
                                                if (isset($_GET['lesson'])) {
                                                    $lesson_id = $_GET['lesson'];
                                                    $_sql = mysqli_query($con, "SELECT * FROM `lesson_pdf` WHERE lesson_id = '$lesson_id'
                                                    ORDER BY pdf_control_number ASC");
                                                    $_result = mysqli_num_rows($_sql);
                                                    if ($_result > 0) {
                                                        while ($row = mysqli_fetch_assoc($_sql)) {
                                                            $content_to_display = $row['pdf_control_number'];
                                                            $pdfid = $row['pdf_id'];
                                                ?>
                                                            <tr>
                                                                <td style="padding: 8px 15px;cursor: pointer;border-bottom: 1px solid #4B49AC;">
                                                                    <a href="index.php?page=_view_materials&pdf=<?php echo $pdfid ?>&from=1&lesson=<?php echo $lesson_id ?>" style="width: 200px;text-decoration: none;color:#4B49AC;" type="button" style="padding-left: 15px;">
                                                                        <i class="ti-file"></i> PDF <?php echo $content_to_display ?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                } else {
                                                    echo "no data found";
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                            <br>
                            <li class="nav-item">
                                <a style="border: 1px solid gray;" class="nav-link" data-toggle="collapse" href="#video" aria-expanded="false" aria-controls="form-elements">
                                    <span class="menu-title">Video Files</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="video">
                                    <div class="form-group">
                                        <table style="background-color: white;" class="table-hover" style="width: 219px;">
                                            <tbody>
                                                <?php
                                                if (isset($_GET['lesson'])) {
                                                    $lesson_id = $_GET['lesson'];
                                                    $_sql = mysqli_query($con, "SELECT lesson.*, lesson_video.*
                                                    FROM lesson_video
                                                    LEFT JOIN lesson ON lesson_video.lesson_id = lesson.lesson_id
                                                    WHERE lesson.lesson_id = '$lesson_id'
                                                    ORDER BY video_control_number ASC");
                                                    $_result = mysqli_num_rows($_sql);
                                                    if ($_result > 0) {
                                                        while ($row = mysqli_fetch_assoc($_sql)) {
                                                            $content_to_display = $row['video_control_number'];
                                                            $videoid = $row['video_id'];
                                                            $videoname = $row['playlist'];
                                                            $lesson_name = $row['lesson_title'];
                                                ?>
                                                            <tr>
                                                                <td style="padding: 8px 15px;cursor: pointer;border-bottom: 1px solid #4B49AC;">
                                                                    <a href="index.php?page=_view_materials&video=<?php echo $videoid ?>&from=1&lesson=<?php echo $lesson_id ?>&vid=<?php echo $videoname ?>&lesson_title=<?php echo $lesson_name ?>" style="width: 200px;text-decoration: none;color:#4B49AC;" type="button" style="padding-left: 15px;">
                                                                        <i class="ti-file"></i> VIDEO <?php echo $content_to_display ?>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                <?php
                                                        }
                                                    }
                                                } else {
                                                    echo "no data found";
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>