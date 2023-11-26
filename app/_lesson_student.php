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

                                $_courseid = $_GET['course'];
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
                                                if ($row['lesson_status'] == "Partial") {
                                                ?>
                                                    <a onclick="partial()" style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" class="btn btn-secondary">
                                                        <i class="ti-alert"></i> READ
                                                    </a>
                                                <?php
                                                } else if ($row['lesson_status'] == "Available") {
                                                ?>
                                                    <a style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" href="actions/log.php?lesson=<?php echo $row['lesson_id'] ?>&name=<?php echo $row['lesson_title'] ?>" class="btn btn-primary">
                                                        <i class="ti-write"></i> READ
                                                    </a>
                                                <?php
                                                } else if ($incrementid) {
                                                ?>
                                                    <a onclick="unavailable()" style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" class="btn btn-warning">
                                                        <i class="ti-alert"></i> READ
                                                    </a>
                                                <?php
                                                }
                                                ?>
                                                <!-- <a style="font-size: 15px;padding: 10px 10px;border-radius: 10px;" href="actions/log.php?lesson=<?php echo $row['lesson_id'] ?>&name=<?php echo $row['lesson_title'] ?>" class="btn btn-primary">
                                                    <i class="ti-write"></i> READ
                                                </a> -->
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
            text: "You need to complete the lesson 1.",
            icon: "info",
            button: "OK",
        });
    }
</script>