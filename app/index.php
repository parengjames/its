<!-- Database connection -->
<?php
include("../config/db_connect.php");
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header('Location: ../index.php?session=expired');
}
?>

<!-- this is the header file -->
<?php include('_header.php') ?>

<div class="container-scroller">
  <!-- partial:partials/_navbar.html -->
  <?php include('_navbar.php') ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <?php include('_settings-panel.php') ?>
    <!-- partial -->

    <!-- partial:partials/_sidebar.html -->
    <?php include('_sidebar.php') ?>
    <!-- partial -->

    <div class="main-panel">
      <?php

      if (isset($_GET['page'])) {
        $page = '' . $_GET['page'] . '.php';
      } else {
        if($_SESSION['login_role'] == 1){
          $page = '_dashboard.php';
        }else if($_SESSION['login_role'] == 2){ 
          $page = '_home.php';
        }
      }

      if (file_exists($page)) {
        include($page);
      } else {
        require_once 'pages/samples/error-404.php';
      }

      // include('_udashboard.php')
      ?>
      <!-- content-wrapper ends -->


      <!-- partial:partials/_footer.html -->

      <?php include('_scripts.php') ?>