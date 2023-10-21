<?php require_once 'page/header.php'?>;

<?php 
        if (isset($_GET['page'])) {
          $page ='page/' .$_GET['page'].'.php';
        }else{
          $page = 'page/home.php';
        }
        if (file_exists($page)) {
          require_once $page; 
        }else{
          require_once 'page/404.php';
        }
 ?>

 <?php require_once 'page/footer.php'; ?>