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
                            <h1 class="h2 mb-0 ls-tight">Manage Foods</h1>
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
                        <a href="add-food.php" class="btn d-inline-flex btn-sm btn-primary"><span>Add Foods</span></a>
                        <div class="mt-3 mb-3">
                        <?php
                        if(isset($_SESSION['add']))
                        echo "<div style='color:green'>".$_SESSION['add']."</div>";
                        unset($_SESSION['add']);
                        ?>
                        <?php
                        if(isset($_SESSION['error']))
                        echo "<div style='color:red'>".$_SESSION['error']."</div>";
                        unset($_SESSION['error']);
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
                        if(isset($_SESSION['delete-food']))
                        echo "<div style='color:green'>".$_SESSION['delete-food']."</div>";
                        unset($_SESSION['delete-food']);
                        ?>
                        <?php
                        if(isset($_SESSION['upload']))
                        echo "<div style='color:red'>".$_SESSION['upload']."</div>";
                        unset($_SESSION['upload']);
                        ?>
                        <?php
                        if(isset($_SESSION['no-food-found']))
                        echo "<div style='color:red'>".$_SESSION['no-food-found']."</div>";
                        unset($_SESSION['no-food-found']);
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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Category ID</th>
                                    <th scope="col">Featured</th>
                                    <th scope="col">Activate</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    // Get all the data of food from database
                                    $sql = "SELECT * FROM tbl_food";
                                    //execute the query
                                    $res = mysqli_query($conn,$sql);
                                    // Check wether the data in database or not
                                    if($res==true){
                                      $count = mysqli_num_rows($res);
                                      $sn=1; //declare variable for serialize values
                                      if($count>0){
                                         // Using While loop to fetch all the records
                                         While($row=mysqli_fetch_assoc($res)){
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            $description = $row['description'];
                                            $price = $row['price'];
                                            $image_name = $row['image_name'];
                                            $category = $row['category_id'];
                                            $featured = $row['featured'];
                                            $active = $row['active'];
                                         ?>
                                         <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $title; ?></td>
                                            <td><?php echo $description; ?></td>
                                            <td>$<?php echo $price; ?></td>
                                            <td>
                                                <?php
                                                if($image_name!=""){
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image_name; ?>" alt="<?php echo $image_name;?>" style="height:50px;width:auto;">
                                                <?php
                                                }else{
                                                echo "<div style='color:red'>Image not Found</div>";
                                                }
                                                ?>
                                                </td>
                                            <td><?php echo $category; ?></td>
                                            <td><?php echo $featured; ?></td>
                                            <td><?php echo $active; ?></td>
                                            <td class="text-center">
                                                <a href="<?php echo SITEURL ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn btn-sm btn-square btn-neutral"><i class="bi bi-pencil"></i></a>
                                                <a href="<?php echo SITEURL ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn btn-sm btn-square btn-neutral text-danger-hover"><i class="bi bi-trash"></i></a>
                                            </td>
                                         </tr>
                                         <?php
                                         }
                                      }else{
                                         echo "<div style='color:red'>No Food Found</div>";
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