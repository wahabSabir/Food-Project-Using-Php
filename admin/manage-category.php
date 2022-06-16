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
                            <h1 class="h2 mb-0 ls-tight">Manage Category</h1>
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
                        <a href="add-category.php" class="btn d-inline-flex btn-sm btn-primary"><span>Add Category</span></a>
                        <div class="mt-3">
                        <?php
                        if(isset($_SESSION['add']))
                        echo "<div style='color:green'>".$_SESSION['add']."</div>";
                        unset($_SESSION['add']);
                        ?>
                        <?php
                        if(isset($_SESSION['remove']))
                        echo "<div style='color:red'>".$_SESSION['remove']."</div>";
                        unset($_SESSION['remove']);
                        ?>
                        <?php
                        if(isset($_SESSION['delete']))
                        echo "<div style='color:green'>".$_SESSION['delete']."</div>";
                        unset($_SESSION['delete']);
                        ?>
                        <?php
                        if(isset($_SESSION['delete_category']))
                        echo "<div style='color:red'>".$_SESSION['delete_category']."</div>";
                        unset($_SESSION['delete_category']);
                        ?>
                        <?php
                        if(isset($_SESSION['no-category-found']))
                        echo "<div style='color:red'>".$_SESSION['no-category-found']."</div>";
                        unset($_SESSION['no-category-found']);
                        ?>
                        <?php
                        if(isset($_SESSION['successful']))
                        echo "<div style='color:green'>".$_SESSION['successful']."</div>";
                        unset($_SESSION['successful']);
                        ?>
                        <?php
                        if(isset($_SESSION['not-successful']))
                        echo "<div style='color:red'>".$_SESSION['not-successful']."</div>";
                        unset($_SESSION['not-successful']);
                        ?>
                        <?php
                        if(isset($_SESSION['failed']))
                        echo "<div style='color:red'>".$_SESSION['failed']."</div>";
                        unset($_SESSION['failed']);
                        ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Active</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Get all data from Category
                                $sql = "SELECT * FROM tbl_category";
                                // Execute the query
                                $res = mysqli_query($conn,$sql);
                                if($res==true){
                                    $sn=1;
                                    $count = mysqli_num_rows($res);
                                    if($count>0){
                                        // to get all the data we use while loop
                                        while($row=mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        $image_name = $row['image_name'];
                                        $featured = $row['featured'];
                                        $active = $row['active'];
                                        ?>
                                    <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>
                                        <?php
                                            if($image_name!=""){
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $image_name;?>" style="height:70px;width:auto;">
                                                <?php
                                            }
                                            else{
                                                echo "<div style='color:red;'>Image not Found</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo SITEURL ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn btn-sm btn-square btn-neutral"><i class="bi bi-pencil"></i></a>
                                        <a href="<?php echo SITEURL ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                         }
                                     }else{
                                        echo "<div style='color:red'>No Category Found</div>";
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