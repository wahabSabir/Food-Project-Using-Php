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
                            <h1 class="h2 mb-0 ls-tight mb-4">Change Password</h1>
                        </div>
                    </div>
                    <!-- Nav -->
                </div>
            </div>
        </header>
        <!-- Main -->
        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        ?>
        <main class="py-6 bg-surface-secondary">
            <div class="container">
              <div class="col-md-6">
                 <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="Enter your name" id="current_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter New Password" id="new_password" required>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter Confirm password" required>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" name="submit" class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
<?php
if(isset($_POST['submit'])){
   $id = $_POST['id'];
   // Get data from form
   $current_password = md5($_POST['current_password']);
   $new_password = md5($_POST['new_password']);
   $confirm_password = md5($_POST['confirm_password']);
   // Check whether the user with current id and current password
   $sql = "SELECT * FROM tbl_admin where id=$id AND password='$current_password'";
   //Execute the query
   $res = mysqli_query($conn,$sql);

   if($res==true){
       $count = mysqli_num_rows($res);
       if($count==1){
            // echo "User is found";
           if($new_password == $confirm_password)
           {
               // Create query o update data in database
               $sql2 ="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
               // Execute the query
               $res2 = mysqli_query($conn,$sql2);
               // Check whether the query is executed or not
               if($res2==true){
                 // Password Changed Successfuly
                 $_SESSION['pwd-update'] = "Password Update Sucessfuly";
                 header("location:".SITEURL."admin/manage-admin.php");
               }else{
                 // password not update
                $_SESSION['pwd-not-update'] = "Password not update";
                header("location:".SITEURL."admin/manage-admin.php");
               }
            }else{
               // password not matched
               $_SESSION['pwd-not-match'] = "Password not matched";
               header("location:".SITEURL."admin/manage-admin.php");
           }
         }
         else{
          // User not found
          $_SESSION['user-not-found'] = "User not found";
          header("location:".SITEURL."admin/manage-admin.php");
        }
    }
}
?>
                </div>
            </div>
        </main>
   </div>