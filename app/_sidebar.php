<?php
if($_SESSION['login_role'] == 1){
  include("include/sidebar_admin.php");
}else if($_SESSION['login_role'] == 2){ 
  include("include/sidebar_student.php");
}
?>