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
                            <h1 class="h2 mb-0 ls-tight">Add Category</h1>
                            <?php
                            if(isset($_SESSION['upload']))
                              echo "<div style='color:red;'>".$_SESSION['upload']."</div>";
                              unset($_SESSION['upload'])
                            ?>
                            <?php
                            if(isset($_SESSION['error']))
                              echo "<div style='color:green;'>".$_SESSION['error']."</div>";
                              unset($_SESSION['error'])
                            ?>
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
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="title">Category Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Category Title" id="full_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="image">Category Image</label>
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
                                    <label for="active">Category Active</label>
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
    if(isset($_POST['featured'])){
        // Get the value from form
        $featured = $_POST['featured'];
    }else{
        //Set default value of featured
        $featured = "No";
    }
    if(isset($_POST['active'])){
        // Get the value from form
        $active = $_POST['active'];
    }else{
        //Set default value of active
        $active = "No";
    }
    // print_r($_FILES['image']);
    // die();
    if(isset($_FILES['image']['name'])){
      // Upload the image if selected
      // For uploading image we need three thing image name, source path and its destination path
      $image_name = $_FILES['image']['name'];
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
                header("location:".SITEURL."admin/add-category.php");
                die();
            }
        }
    }
    else{
      // Do not upload the image if image is not selected
      $image_name = "";
    }
    // sql query to insert category into database
    $sql = "INSERT INTO tbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active'";
    // Execute the query
    $res = mysqli_query($conn,$sql);
    // Check wether the query is exectued or not
    if($res==true){
      // query exectued and category added
      $_SESSION['add'] = "Category added successfuly";
      // Redirect message
      header("location:".SITEURL."admin/manage-category.php");
    }else{
        // Failed to add category
        $_SESSION['error'] = "Failed to add category";
       // Redirect message
       header("location:".SITEURL."admin/add-category.php");
    }
}
?>
                </div>
            </div>
        </main>
   </div>