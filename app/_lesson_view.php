<div style="padding-top: 20px;" class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div id="up" class="card">
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
                        $_SESSION['from_lesson'] = $lesson_id;
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
                                                                    <a href="index.php?page=_view_materials&pdf=<?php echo $pdfid ?>&from=2&lesson=<?php echo $lesson_id ?>&side=unlock" style="width: 200px;text-decoration: none;color:#4B49AC;" type="button" style="padding-left: 15px;">
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
                                                                    <a href="index.php?page=_view_materials&video=<?php echo $videoid ?>&from=2&side=unlock&lesson=<?php echo $lesson_id ?>&vid=<?php echo $videoname ?>&lesson_title=<?php echo $lesson_name ?>" style="width: 200px;text-decoration: none;color:#4B49AC;" type="button" style="padding-left: 15px;">
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

    <div style="text-align: center;" class="col-md-12 grid-margin">
        <button data-toggle="modal" data-target="#confirmation" style="font-size: 15px;" type="button" class="btn btn-primary btn-sm">
            <i class="ti-pencil"></i> Take Quiz now?
        </button>
        <?php
        $user = $_SESSION['user_id'];
        $lesson_id = $_SESSION['from_lesson'];
        $sqlquery1 = mysqli_query($con, "SELECT * FROM `quiz_results` WHERE `user_id` = $user AND `lesson_id`= $lesson_id");
        $results1 = mysqli_num_rows($sqlquery1);
        if ($results1 > 0) {
        ?>
            <a href="index.php?page=_quiz_result_view&side=unlock" style="font-size: 15px;" type="button" class="btn btn-primary btn-sm">
                <i class="ti-eye"></i> View results
            </a>
        <?php
        }
        ?>

    </div>
</div>

<div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 150px;text-align: center;" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img style="margin-bottom: 25px;" src="images/quizgif.gif" alt="">
                <h4>Take quiz</h4><br>
                <p>Have you prepared for the quiz? Ensure you've reviewed the lesson.</p>
                <br>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                <a href="actions/log.php?fromlesson=<?php echo $_SESSION['from_lesson'] ?>" type="button" class="btn btn-primary">Proceed</a>
            </div>
        </div>
    </div>
</div>