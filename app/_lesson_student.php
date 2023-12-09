<div class="content-wrapper">
    <div class="tabform col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 grid-margin">
                    <div style="margin-bottom: -30px;" class="row">
                        <div class="col-12 col-xl-8 mb-xl-0">
                            <h3 class="font-weight-bold">Available Lessons</h3>
                        </div>
                    </div>
                </div>

                <div style="padding-left: 30px;padding-right: 30px;" class="table-responsive">
                    <table class="table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Lesson No.</th>
                                <th>Lesson Title</th>
                                <th style="width: 250px;">status</th>
                                <th style="width: 80px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['course'])) {
                                $user_id = $_SESSION['user_id'];
                                $_courseid = $_GET['course'];
                                $_SESSION['course_id'] = $_courseid;
                                $sql = mysqli_query($con, "SELECT * FROM `lesson` WHERE `subject_id`=$_courseid
                                ORDER BY `lesson_id` ASC");
                                $result = mysqli_num_rows($sql);
                                $number = 1;
                                if ($result > 0) {

                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $les_id = $row['lesson_id'];
                                        $incrementid = ++$les_id;
                            ?>
                                        <tr>
                                            <td><?php echo $number++ ?></td>
                                            <td class="font-weight-bold"><?php echo $row['lesson_title'] ?></td>
                                            <td class="font-weight-medium">
                                                <?php
                                                $sqlquery = mysqli_query($con, "SELECT * FROM `lesson_logs` WHERE
                                                `user_id` = '" . $_SESSION['user_id'] . "' AND `lesson_id` = '" . $row['lesson_id'] . "'");
                                                $res = mysqli_num_rows($sqlquery);

                                                if ($res > 0) {
                                                ?>
                                                    <div style="font-weight: bold;" class="badge badge-success">Todo: Done</div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div style="font-weight: bold;" class="badge badge-warning">Todo: View</div>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                $sqlquery2 = mysqli_query($con, "SELECT MIN(lesson_id) AS first_lesson FROM `lesson`");
                                                $sqlresult2 = mysqli_num_rows($sqlquery2);
                                                if ($sqlresult2 > 0) {
                                                    while ($row2 = mysqli_fetch_assoc($sqlquery2)) {
                                                        $first_lesson = $row2['first_lesson'];
                                                    }
                                                }

                                                if ($row['lesson_status'] == "Partial" || $row['lesson_status'] == "Unavailable") {
                                                ?>
                                                    <a onclick="partial()" style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" class="btn btn-secondary">
                                                        <i class="ti-alert"></i> READ
                                                    </a>
                                                    <?php
                                                } else if ($row['lesson_status'] == "Available") {

                                                    if ($row['lesson_id'] == $first_lesson) {
                                                    ?>
                                                        <a style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" href="actions/log.php?lesson=<?php echo $row['lesson_id'] ?>&name=<?php echo $row['lesson_title'] ?>" class="btn btn-primary">
                                                            <i class="ti-write"></i> READ
                                                        </a>
                                                        <?php
                                                    }

                                                    if ($row['lesson_id'] > $first_lesson) {

                                                        if (isset($_SESSION['activity_id_from_results'])) {
                                                            $actibiti = $_SESSION['activity_id_from_results'];
                                                        } else {
                                                            $actibiti = 1;
                                                        }
                                                        $sqlquery3 = mysqli_query($con, "SELECT is_passed FROM `quiz_results` 
                                                        WHERE user_id = $user_id AND activity_id = $actibiti
                                                        ORDER BY quiz_result_id DESC
                                                        LIMIT 1");
                                                        $result3 = mysqli_num_rows($sqlquery3);
                                                        if ($result3 > 0) {
                                                            while ($row3 = mysqli_fetch_assoc($sqlquery3)) {
                                                                $pasar_wala = $row3['is_passed'];

                                                                if ($pasar_wala == 1) {
                                                        ?>
                                                                    <a style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" href="actions/log.php?lesson=<?php echo $row['lesson_id'] ?>&name=<?php echo $row['lesson_title'] ?>" class="btn btn-primary">
                                                                        <i class="ti-write"></i> READ
                                                                    </a>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <a onclick="unavailable()" style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" class="btn btn-warning">
                                                                        <i class="ti-alert"></i> READ
                                                                    </a>
                                                            <?php
                                                                }
                                                            }
                                                        } else {
                                                            ?>
                                                            <a onclick="unavailable()" style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" class="btn btn-warning">
                                                                <i class="ti-alert"></i> READ
                                                            </a>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            } else {
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function partial() {
        swal({
            title: "Lesson status",
            text: "Lesson materials are not yet ready.",
            icon: "info",
            button: "OK",
        });
    }
</script>

<script>
    function unavailable() {
        swal({
            title: "Lesson status",
            text: "You need to pass and complete the lesson 1.",
            icon: "info",
            button: "OK",
        });
    }
</script>