<style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    .card-container {
        display: flex;
        justify-content: left;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .card {
        width: 325px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        margin: 20px;
    }

    .card img {
        width: 100%;
        height: auto;
    }

    .card-content {
        padding: 16px;
    }

    .card-content h3 {
        font-size: 25px;
        margin-bottom: 8px;
    }

    .card-content p {
        color: #666;
        font-size: 13px;
        line-height: 1.3;
    }

    .card-content .btn {
        display: inline-block;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4%;
        margin-top: 16px;
    }
</style>

<div class="content-wrapper">
    <h3>
        Available Courses
    </h3>
    <ul>
        <?php
        $sql = mysqli_query($con, "SELECT * FROM `subject`");
        $result_sql = mysqli_num_rows($sql);
        if ($result_sql > 0) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $_SESSION['course_id'] = $row['subject_id'];
        ?>
                <li>
                    <div class="card-container">
                        <div class="card">
                            <img src="images/card_bg.jpg" alt="">
                            <div class="card-content">
                                <h3><?php echo $row['subject_name'] ?></h3>
                                <p>
                                    <?php echo $row['subject_about'] ?>
                                </p>
                                <a href="actions/log.php?course=<?php echo $row['subject_id'] ?>&name=<?php echo $row['subject_name'] ?>" class="btn btn-primary">Study now</a>                            </div>
                        </div>
                    </div>
                </li>
        <?php
            }
        }
        ?>
    </ul>

</div>