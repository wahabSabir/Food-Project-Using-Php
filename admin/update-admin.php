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
                            <h1 class="h2 mb-0 ls-tight mb-4">Update Admin</h1>
                            <?php
                            if(isset($_SESSION['add']))
                              echo $_SESSION['add'];
                              unset($_SESSION['add'])
                            ?>
                        </div>
                    </div>
                    <!-- Nav -->
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
                     // Get the id of the selected admin
                     if(isset($_GET['id'])){
                      $id = $_GET['id'];
                     // Execute the query to get the detail
                      $sql = "SELECT * FROM tbl_admin WHERE id=$id";
                     // Execute query
                      $res = mysqli_query($conn,$sql);
                      // Check wether the data is available or not
                      if($res==TRUE){
                        $count = mysqli_num_rows($res);
                        if($count==1){
                            $data = mysqli_fetch_assoc($res);
                            $full_name = $data['full_name'];
                            $username = $data['username'];
                            }
                        else{
                            // Redirect to Manage admin Page
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                        }
                        }else
                        {
                            // Redirect to Manage Admin Page
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                        ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>" id="full_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" id="username" required>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <button type="submit" name="submit" class="btn btn-primary">Update Admin</button>
                        </form>
                    </div>
<?php
 if(isset($_POST['submit'])){
    // Get all the value from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    // Create a sql query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'";
    // Execute the query
    $res = mysqli_query($conn,$sql);
    //Check wether the query is executed or not
    if($res==TRUE){
    // Query Executed and Update Admin
    $_SESSION['update'] = "Admin Updated Successfuly";
    header("location:".SITEURL."admin/manage-admin.php");
    }
    else{
    // Failed to update admin
    $_SESSION['update'] = "Failed to update Admin";
    header("location:".SITEURL."admin/manage-admin.php");
    }
 }
?>
                </div>
            </div>
        </main>
   </div>