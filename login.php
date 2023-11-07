<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>eLearning login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="app/vendors/feather/feather.css">
  <link rel="stylesheet" href="app/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="app/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="app/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="app/images/favicon.png" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
require_once "parts/login-header.php";
?>

<style>
  .container-fluid {
    margin: 0;
    padding: 0;
  }

  .content-wrapper {
    background: linear-gradient(to right, #87CEFA, #FAFAD2);
  } 
</style>

<body>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="content-wrapper d-flex align-items-center auth ">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div style="margin-top: -90px;" class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form method="POST" action="config/login_checkpoint.php" class="pt-3">
                <div class="form-group">
                  <input name="username" type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                  <!-- Error alert -------------------------- -->
                  <?php
                  if (isset($_GET['error']) != null) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      ' . $_GET['error'] . '
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
                  } else if (isset($_GET['return']) != null) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ' . $_GET['return'] . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                  }
                  ?>
                  <!-- Error alert -------------------------- -->
                </div>
                <div class="mt-3">
                  <button name="submit" type="submit" style="font-size: 18px;" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="">SIGN IN</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  <a style="font-size: 16px;" href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="text-center mt-2 font-weight-light">
                  Don't have an account? <a href="register" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script>

  </script>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="app/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="app/js/off-canvas.js"></script>
  <script src="app/js/hoverable-collapse.js"></script>
  <script src="app/js/template.js"></script>
  <script src="app/js/settings.js"></script>
  <script src="app/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>