<?php
 // add connection
 include('../config/constants.php');
 // Get the id of admin to be deleted
 $id = $_GET['id'];
 // Create sql query to delete admin
 $sql = "DELETE FROM tbl_admin WHERE id=$id";
 // Execute the query
 $res = mysqli_query($conn,$sql);
// Check whether the query is executed or not
if($res==TRUE){
  // Query is executed then delete the admin
  $_SESSION['delete'] = "Admin Deleted Successfuly";
  header("location:".SITEURL."admin/manage-admin.php");
}
else{
  // Failed to delete the admin
  $_SESSION['delete'] = "Failed to delete admin";
  header("location:".SITEURL."admin/manage-admin.php");
}
?>