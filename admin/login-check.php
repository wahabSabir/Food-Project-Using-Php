<?php
 if(!isset($_SESSION['user'])){
     $_SESSION['login-check'] = "Please Login to Access Admin Panel";
     header("location:".SITEURL."admin/login.php");
 }
?>