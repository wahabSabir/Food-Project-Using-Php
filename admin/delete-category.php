<?php
include('../config/constants.php');
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
  // Get the values
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];
  // Check whether image is available or not
  if($image_name!=""){
    $path = "../images/category/".$image_name;
    $remove = unlink($path);
    if($remove==false){
        $_SESSION['remove'] = "Failed to remove Category Image";
        header("location:".SITEURL."admin/manage-category.php");
        die();
    }
    $sql = "DELETE FROM tbl_category WHERE id=$id AND image_name='$image_name'";
    $res = mysqli_query($conn,$sql);
    if($res==true){
       $_SESSION['delete'] = "Category Deleted Successfuly";
       header("location:".SITEURL."admin/manage-category.php");
    }else{
        $_SESSION['delete-category'] = "Failed to delete category";
        header("location:".SITEURL."admin/manage-category.php");
    }
  }
}
else{
    // Redirect to manage category page
    header("location:".SITEURL."admin/manage-category.php");
}
?>