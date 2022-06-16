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
                            <h1 class="h2 mb-0 ls-tight mb-4">Add Admin</h1>
                            <?php
                            if(isset($_SESSION['add']))
                              echo "<div style='color:red;'>".$_SESSION['add']."</div>";
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
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Enter your name" id="full_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter username" id="username" required>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <button type="submit" name="submit" class="btn btn-primary">Add Admin</button>
                        </form>
                    </div>
<?php
 if(isset($_POST['submit'])){
    // Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    // SQL query to execute data in database

    $sql = "INSERT INTO tbl_admin SET
     full_name = '$full_name',
     username = '$username',
     password = '$password'";
    // Execute query and save data in database
    $run = mysqli_query($conn,$sql) or die(mysqli_error($conn));
    // check whether the (query execute) data is inserted or not display appropriate message
    if($run==TRUE){
        // Data is inserted
        $_SESSION['add'] = "Admin added Successfuly";
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else{
        // Data is not inserted
        $_SESSION['add'] = "Admin not added";
        header("location:".SITEURL."admin/add-admin.php");
    }
 }
?>
                </div>
            </div>
        </main>
   </div>