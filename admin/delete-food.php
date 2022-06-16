<?php
// Include Database Connection
include('../config/constants.php');
// Get values
if(isset($_GET['id']) AND isset($_GET['image_name'])){
   $id = $_GET['id'];
   $image_name = $_GET['image_name'];
// Remove the image if it available and check whether the image is available or not
if($image_name!=""){
    $remove_path = "../images/foods/".$image_name;
    $remove = unlink($remove_path);
    // Check wether the image is removed or not
    if($remove==false){
        $_SESSION['remove'] = "Failed to remove image";
        header("location:".SITEURL."admin/manage-foods.php");
        die();
    }
    $sql = "DELETE FROM tbl_food WHERE id=$id AND image_name='$image_name'";
    $res = mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['delete'] = "Food Deleted Successfuly";
        header("location:".SITEURL."admin/manage-foods.php");
    }else{
        $_SESSION['delete-food'] = "Failed to delete food";
        header("location:".SITEURL."admin/manage-foods.php");
    }
  }
}
else{
    // Redirect to manage food page
    header("location:".SITEURL."admin/manage-foods.php");
}
?>