<div class="content-wrapper">
    <div class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div style="margin-bottom: -30px;" class="row">
                            <div class="col-12 col-xl-8 mb-xl-0">
                                <h3 class="font-weight-bold">📜 Your Quiz results 🧾</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top: -25px;" class="row">
        <div class="tabform col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 grid-margin">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr style="font-weight: bold;">
                                        <td>Activity name</td>
                                        <td>Score</td>
                                        <td>Date</td>
                                        <td>Remarks</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $user = $_SESSION['user_id'];
                                    $lesson = $_SESSION['from_lesson'];
                                    $sqlquery1 = mysqli_query($con, "SELECT quiz_results.*, activity.activity_name
                                    FROM `quiz_results`
                                    INNER JOIN activity ON quiz_results.activity_id = activity.activity_id
                                    WHERE user_id = $user AND quiz_results.lesson_id = $lesson");

                                    $result1 = mysqli_num_rows($sqlquery1);
                                    if ($result1 > 0) {
                                        while ($row1 = mysqli_fetch_assoc($sqlquery1)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row1['activity_name'] ?></td>
                                                <td><?php echo $row1['final_scores'] ?></td>
                                                <td><?php echo date('F d Y, h:i:s A', strtotime($row1['date_saved'])) ?></td>
                                                <td>
                                                    <?php
                                                    if ($row1['is_passed'] == 1) {
                                                    ?>
                                                        <div style="font-weight: bold;" class="badge badge-success">Passed</div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div style="font-weight: bold;" class="badge badge-danger">Failed</div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
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