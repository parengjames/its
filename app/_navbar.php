<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a style="font-weight: bold;" class="navbar-brand brand-logo mr-5" href="index"><img src="images/logo.png" class="mr-2" alt="logo" />eLearning</a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo.png" alt="logo" /></a>
  </div>

  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>

    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <?php
        if ($_SESSION['login_role'] == 2) {
        ?>
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="icon-bell mx-0"></i>
            <span class="count"></span>
          </a>
        <?php
        }
        ?>
        <div style="min-height: 100px;max-height: 350px; overflow-y: scroll;" class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Activities</p>
          <ul>
            <?php
            $login_user = $_SESSION['user_id'];
            $sql_query = mysqli_query($con, "SELECT * FROM `action_logs` WHERE `user_id` = '$login_user'");
            $result = mysqli_num_rows($sql_query);
            if ($result > 0) {
              while ($row = mysqli_fetch_assoc($sql_query)) {
                $action = $row['log_name'];
                $time = $row['date_time'];
            ?>
                <div class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="ti-info-alt mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal"><?php echo $action ?></h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      <?php echo date('F d Y, h:i:s A', strtotime($time)) ?>
                    </p>
                  </div>
                </div>
              <?php
              }
            } else {
              ?>
              <div class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">NO DATA FOUND</h6>
                </div>
              </div>
            <?php
            }
            ?>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="images/header/user icon.png" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <?php
          $first_name = $_SESSION['firstname'];
          $last_name = $_SESSION['lastname'];
          ?>
          <span class="dropdown-item" style="font-weight: bold;"><?php echo $first_name." ".$last_name ?></span>
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i>
            Profile
          </a>
          <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
            <i class="ti-power-off text-primary"></i>
            Logout
          </a>
        </div>
      </li>
      <?php
      if ($_SESSION['login_role'] == 2) {
      ?>
        <li class="nav-item nav-settings d-none d-lg-flex">
          <a class="nav-link" href="#">
            <i class="icon-ellipsis"></i>
          </a>
        </li>
      <?php
      }
      ?>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>