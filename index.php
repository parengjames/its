<?php require_once 'parts/header.php';?>

  <!-- Content Wrapper. Contains page content -->

  <?php 
        if (isset($_GET['page'])) {
          $page ='parts/' .$_GET['page'].'.php';
        }else{
          $page = 'parts/body.php';
        }
        if (file_exists($page)) {
          require_once $page; 
        }else{
          require_once 'parts/404-error.php';
        }
 ?>

 <?php require_once 'parts/footer.php'; ?>