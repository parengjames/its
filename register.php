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
  <!-- <link rel="shortcut icon" href="app/images/favicon.png" /> -->
</head>

<?php
  require_once "parts/register-header.php";
?>

<style>
  .container-fluid{
    margin: 0;
    padding: 0;
  }
  .content-wrapper{
    background: linear-gradient(to right,#87CEFA, #FAFAD2);
  }
  .box{
    border-radius: 5px;
    height: 620px;
    overflow-y: auto;
  }
</style>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <!-- The card here............. -->
            <div class="box  auth-form-light text-left py-5 px-4 px-sm-5">
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="emailadd" name="email" placeholder="Email address">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="username" name="Username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="confpass" name="confirmpassword" placeholder="Confirm password">
                </div>
                <h6 class="font-weight-medium">Personal Information</h6>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="firstname" name="firstname" placeholder="Firstname">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="lastname" name="lastname" placeholder="Lastname">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">SIGN UP</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login" class="text-primary">Login</a>
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
