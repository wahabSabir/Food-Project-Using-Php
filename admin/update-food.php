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
                            <h1 class="h2 mb-0 ls-tight">Update Foods</h1>

                        </div>
                    </div>
                    <!-- Nav -->
                    <ul class="nav nav-tabs mt-4 overflow-x border-0">
                    </ul>
                </div>
            </div>
        </header>
        <!-- Main -->
        <main class="py-6 bg-surface-secondary">
            <div class="container">
              <div class="col-md-6">
                 <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <?php
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM tbl_food WHERE id=$id";
                            $res = mysqli_query($conn,$sql);
                            if($res==true){
                                $count = mysqli_num_rows($res);
                                if($count==1){
                                    $row = mysqli_fetch_assoc($res);
                                    $title = $row['title'];
                                    $description = $row['description'];
                                    $price = $row['price'];
                                    $current_image = $row['image_name'];
                                    $category = $row['category_id'];
                                    $featured = $row['featured'];
                                    $active = $row['active'];
                                }
                                else{
                                    // Redirect to Manage food Page
                                    $_SESSION['no-food-found'] = "No food Found";
                                    header("location:".SITEURL."admin/manage-foods.php");
                                }
                                }
                                }else
                                {
                                    // Redirect to Manage food Page
                                    header("location:".SITEURL."admin/manage-foods.php");
                                }
                        ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="title">Food Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="description">Food Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2"><?php echo htmlspecialchars($description); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Food price</label>
                                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="image">Food Image</label>
                                    <div class="mb-3">
                                        <?php
                                          if($current_image!=""){
                                        ?>
                                          <img src="<?php echo SITEURL;?>images/foods/<?php echo $current_image; ?>" style="height:30px;width:auto;">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="category">Food Category</label>
                                    <select class="form-select" name="category">
                                    <?php
                                     $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                     $res = mysqli_query($conn,$sql2);
                                     if($res==true){
                                         $count = mysqli_num_rows($res);
                                         if($count>0){
                                             while($row=mysqli_fetch_assoc($res)){
                                              $id = $row['id'];
                                              $title = $row['title'];
                                            ?>
                                             <option <?php if($category==$id){echo "selected";} ?> value="<?php echo $id;?>"><?php echo $title; ?></option>
                                            <?php
                                             }
                                         }else{
                                             ?>
                                             <option value="0">No Record Found</option>
                                             <?php
                                         }
                                     }
                                    ?>
                                     </select>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="featured">Food featured</label>
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
                                    <label for="active">Food Active</label>
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
$description = $_POST['description'];
$price = $_POST['price'];
$current_image = $_POST['current_image'];
$category = $_POST['category'];
$featured = $_POST['featured'];
$active = $_POST['active'];
// Updating new image if selected
if(isset($_FILES['image']['name']))
{
    $image_name = $_FILES['image']['name'];
    //check whether the image is available or not
    if($image_name!=""){
     $tmp = explode('.', $image_name);
     //Get the extension of our image
     $ext = end($tmp);
     $image_name = "Foods_".rand(0000,9999).'.'.$ext;
     // source path or temparary name
     $source_path = $_FILES['image']['tmp_name'];
     // destination path for location where picture is upload
     $destination_path = "../images/foods/".$image_name;
     // finally upload the image
     $upload = move_uploaded_file($source_path,$destination_path);
     if($upload==false)
     {
        $_SESSION['upload'] = "Failed to upload new Image";
        header("location:".SITEURL."admin/manage-foods.php");
         die();
     }
     // Remove the Current Image
     if($current_image!=""){
     $remove_path = "../images/foods/".$current_image;
     $remove = unlink($remove_path);
     // check whether the image is removed or not
     if($remove==false){
        $_SESSION['remove'] = "Failed to remove image from foods";
        // header("location:".SITEURL."admin/manage-foods.php");
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
    $sql3 = "UPDATE tbl_food SET
    title='$title',
    description='$description',
    price='$price',
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active' WHERE id=$id";
    $res3 = mysqli_query($conn,$sql3);
    if($res3==true){
        $_SESSION['successful'] = "Food update succesfuly";
        header("location:".SITEURL."admin/manage-foods.php");
    }else{
        $_SESSION['not-successful'] = "Failed to Update Food";
        header("location:".SITEURL."admin/manage-foods.php");
    }
}
?>
                </div>
            </div>
        </main>
   </div>