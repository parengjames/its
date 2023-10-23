<?php
include("../config/db_connect.php");
?>

<div class="container-scroller">
  <!-- partial:partials/_navbar.html -->
  <?php include('partials/_navbar.php') ?>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->
    <?php include('partials/_settings-panel.php') ?>
    <!-- partial -->

    <!-- partial:partials/_sidebar.html -->
    <?php include('partials/_sidebar.php') ?>
    <!-- partial -->
    <div class="main-panel">
    <?php include('_udashboard.php')?>
      <!-- content-wrapper ends -->

      <!-- partial:partials/_footer.html -->
    <?php include('partials/_footer.php') ?>