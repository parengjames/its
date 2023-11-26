<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index ">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <?php
        if (isset($_GET['side']) == "unlock") {
            $course =  $_SESSION['course_id'];
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=_lesson_student&course=<?php echo $course ?>">
                    <i class="ti-folder"></i>
                    <span style="margin-left: 18px;" class="menu-title">Lesson</span>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>