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
                            <h1 class="h2 mb-0 ls-tight">Add Foods</h1>

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
                        if(isset($_SESSION['upload']))
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="title">Food Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Food Title" id="full_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="description">Food Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="2" placeholder="Enter Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Food price</label>
                                    <input type="text" name="price" class="form-control" placeholder="Enter Food price" id="full_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="image">Food Image</label>
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
                                     $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                     $res = mysqli_query($conn,$sql);
                                     if($res==true){
                                         $count = mysqli_num_rows($res);
                                         if($count>0){
                                             while($row=mysqli_fetch_assoc($res)){
                                              $id = $row['id'];
                                              $title = $row['title'];
                                            ?>
                                             <option value="<?php echo $id;?>"><?php echo $title; ?></option>
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
                                    <input type="radio" name="featured" value="Yes"> Yes
                                    </label>
                                    <label class="radio-inline" style="margin-left:1rem;">
                                    <input type="radio" name="featured" value="No"> No
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
                                    <input type="radio" name="active" value="Yes"> Yes
                                    </label>
                                    <label class="radio-inline" style="margin-left:1rem;">
                                    <input type="radio" name="active" value="No"> No
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
<?php
if(isset($_POST['submit'])){
    // check whether the button is clicked
    // echo "Button clicked";
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    // Check wether the featured is checked or not
    if(isset($_POST['featured'])){
        $featured = $_POST['featured'];
    }else{
        // default value set
        $featured = "No";
    }
    // Check wether the active is checked or not
    if(isset($_POST['active'])){
        $active = $_POST['active'];
    }else{
        // default value set
        $active = "No";
    }
    // Check wether the image is selected or not and upload the image if selected
    if(isset($_FILES['image']['name'])){
        // For picture upload we give image name,source path and its destination path
        $image_name = $_FILES['image']['name'];
        if($image_name!=""){
        //Get the extension of our image
        $ext = end(explode('.',$image_name));
        $image_name = "Foods_".rand(0000,9999).'.'.$ext;
        // source path or temparary name
        $source_path = $_FILES['image']['tmp_name'];
        // destination path for location where picture is upload
        $destination_path = "../images/foods/".$image_name;
        // finally upload the image
        $upload = move_uploaded_file($source_path,$destination_path);
        //Check wether the image is upload or not
        if($upload==false){
         $_SESSION['upload'] = "Failed to Upload Image";
         header("location:".SITEURL."admin/add-food.php");
         die(); //End the process
        }
      }
    }else{
        // Do not upload the image if the selected field is empty
        $image_name = "";
    }
     $sql = "INSERT INTO tbl_food SET title='$title',description='$description',price='$price',category_id='$category',image_name='$image_name',featured='$featured',active='$active'";
     // Execute the Query
     $res = mysqli_query($conn,$sql);
     // Check wether the query is exectued or not
     if($res==true){
      // Query executed and Food saved to database
      $_SESSION['add'] = "Add food Successfuly";
      header("location:".SITEURL."admin/manage-foods.php");
     }else{
      // Food is not saved in database
      $_SESSION['error'] = "Failed to Add food";
      header("location:".SITEURL."admin/manage-foods.php");
     }
}
?>
                </div>
            </div>
        </main>
   </div>