<?php include('menu.php'); ?>
    <!-- Main content -->
    <div class="h-screen flex-grow-1">
        <!-- Header -->
        <header class="bg-surface-primary border-bottom pt-6">
            <div class="container-fluid">
                <div class="mb-npx">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-12 mb-4 mb-sm-0">
                            <!-- Title -->
                            <h1 class="h2 mb-0 ls-tight mb-4">Update Category</h1>

                        </div>
                    </div>
                    <!-- Nav -->
                </div>
            </div>
        </header>
        <!-- Main -->
         <!-- Main -->
         <main class="py-6 bg-surface-secondary">
            <div class="container">
              <div class="col-md-6">
                 <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <?php
                        if(isset($_SESSION['upload']))
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                        ?>
                        <?php
                         if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM tbl_category WHERE id=$id";
                            $res = mysqli_query($conn,$sql);
                            if($res==true){
                                $count = mysqli_num_rows($res);
                                if($count==1){
                                    $data = mysqli_fetch_assoc($res);
                                    $title = $data['title'];
                                    $current_image = $data['image_name'];
                                    $featured = $data['featured'];
                                    $active = $data['active'];

                                }
                                else{
                                    // Redirect to Manage category Page
                                    $_SESSION['no-category-found'] = "No Category Found";
                                    header("location:".SITEURL."admin/manage-category.php");
                                }
                                }
                                }else
                                {
                                    // Redirect to Manage category Page
                                    header("location:".SITEURL."admin/manage-category.php");
                                }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="title">Category Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="image">Category Image</label>
                                    <div class="mb-3">
                                        <?php
                                          if($current_image!=""){
                                        ?>
                                          <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" style="height:30px;width:auto;">
                                          <?php
                                          }else{
                                            echo "<div style='color:red'>Image Not Found</div>";
                                          }
                                         ?>
                                    </div>
                                    <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="featured">Category featured</label>
                                    <label class="radio-inline" style="margin-left:2rem;">
                                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                                    </label>
                                    <label class="radio-inline" style="margin-left:1rem;">
                                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <!--  row  -->
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="active">Category Active</label>
                                    <label class="radio-inline" style="margin-left:2rem;">
                                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                                    </label>
                                    <label class="radio-inline" style="margin-left:1rem;">
                                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>" >
                            <input type="hidden" name="id" value="<?php echo $id;?>" >
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
<?php
if(isset($_POST['submit'])){
// Get all the values from form
$id = $_POST['id'];
$title = $_POST['title'];
$current_image = $_POST['current_image'];
$featured = $_POST['featured'];
$active = $_POST['active'];
// Updating new image if selected
if(isset($_FILES['image']['name']))
{
    $image_name = $_FILES['image']['name'];
    //check whether the image is available or not
    if($image_name!=""){
     // Get the extension for our image
     $ext = end(explode('.',$image_name));
     // Rename the image
     $image_name = "Food_category_".rand(0000,9999).'.'.$ext;

     $source_path = $_FILES['image']['tmp_name'];
     $destination_path = "../images/category/".$image_name;

     // finally upload the image
     $upload = move_uploaded_file($source_path,$destination_path);
     if($upload==false)
     {
         $_SESSION['upload'] = "Image not upload";
         header("location:".SITEURL."admin/update-category.php");
         die();
     }
     // Remove the Current Image
     if($current_image!=""){
     $remove_path = "../images/category/".$current_image;
     $remove = unlink($remove_path);
     // check whether the image is removed or not
     if($remove==false){
        $_SESSION['failed'] = "Failed to remove image from category";
        header("location:".SITEURL."admin/manage-category.php");
        die();
     }
    }
    }else{
        $image_name = $current_image;
     }
    }else{
        $image_name = $current_image;
    }
    // update the database
    $sql2 = "UPDATE tbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active' WHERE id=$id";
    $res2 = mysqli_query($conn,$sql2);
    if($res2==true){
        $_SESSION['successful'] = "Category update succesfuly";
        header("location:".SITEURL."admin/manage-category.php");
    }else{
        $_SESSION['not-successful'] = "Failed to Update Category";
        header("location:".SITEURL."admin/manage-category.php");
    }
}
?>
                </div>
            </div>
        </main>
   </div>