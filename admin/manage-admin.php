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
                            <h1 class="h2 mb-0 ls-tight">Manage Admin</h1>
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
            <div class="container-fluid">
               <div class="card shadow border-0 mb-7">
                    <div class="card-header">
                        <a href="add-admin.php" class="btn d-inline-flex btn-sm btn-primary"><span>Add Admin</span></a>
                        <div class="mt-3">
                            <?php
                                if(isset($_SESSION['add']))
                                echo "<div style='color:green;'>".$_SESSION['add']."</div>";
                                unset($_SESSION['add'])
                            ?>
                            <?php
                                if(isset($_SESSION['delete']))
                                echo "<div style='color:green;'>".$_SESSION['delete']."</div>";
                                unset($_SESSION['delete'])
                            ?>
                            <?php
                                if(isset($_SESSION['update']))
                                echo "<div style='color:green;'>".$_SESSION['update']."</div>";
                                unset($_SESSION['update'])
                            ?>
                            <?php
                                if(isset($_SESSION['user-not-found']))
                                echo "<div style='color:red;'>".$_SESSION['user-not-found']."</div>";
                                unset($_SESSION['user-not-found'])
                            ?>
                            <?php
                                if(isset($_SESSION['pwd-not-match']))
                                echo "<div style='color:red;'>".$_SESSION['pwd-not-match']."</div>";
                                unset($_SESSION['pwd-not-match'])
                            ?>
                            <?php
                                if(isset($_SESSION['pwd-update']))
                                echo "<div style='color:green;'>".$_SESSION['pwd-update']."</div>";
                                unset($_SESSION['pwd-update'])
                            ?>
                            <?php
                                if(isset($_SESSION['pwd-not-update']))
                                echo "<div style='color:red;'>".$_SESSION['pwd-not-update']."</div>";
                                unset($_SESSION['pwd-not-update'])
                            ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                 // Get all admin table data from database
                                 $sql = "SELECT * FROM tbl_admin";
                                 // Execute the Query
                                 $res = mysqli_query($conn,$sql);
                                 if($res==TRUE)
                                 {
                                    $count = mysqli_num_rows($res);
                                    $sn = 1; // serial number default value set
                                     if($count>0){
                                         while($row=mysqli_fetch_assoc($res)){
                                            // Get individual Data
                                             $id = $row['id'];
                                             $full_name = $row['full_name'];
                                             $username = $row['username'];
                                            ?>
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo SITEURL ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn btn-sm btn-square btn-neutral"><i class="bi bi-box-arrow-up"></i></a>
                                                <a href="<?php echo SITEURL ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn btn-sm btn-square btn-neutral"><i class="bi bi-pencil"></i></a>
                                                <a href="<?php echo SITEURL ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                            <?php
                                         }
                                     }else{
                                        echo "<div style='color:red'>No Admin Found</div>";
                                     }
                                 }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>