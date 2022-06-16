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
                            <h1 class="h2 mb-0 ls-tight">Manage Orders</h1>
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
                        <a class="btn d-inline-flex btn-sm btn-primary"><span>All Orders</span></a>
                    </div>
                    <div class="mt-3">
                            <?php
                                if(isset($_SESSION['update-order']))
                                echo "<div style='color:green;'>".$_SESSION['update-order']."</div>";
                                unset($_SESSION['update-order'])
                            ?>
                            <?php
                                if(isset($_SESSION['update-error']))
                                echo "<div style='color:green;'>".$_SESSION['update-error']."</div>";
                                unset($_SESSION['update-error'])
                            ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SN</th>
                                    <th scope="col">Food</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //get all data from database
                                $sql = "SELECT * FROM tbl_order order by id DESC";
                                // execute the query
                                $res = mysqli_query($conn,$sql);
                                if($res == true){
                                  $count = mysqli_num_rows($res);
                                  $sn=1;
                                  if($count>0){
                                      While($row=mysqli_fetch_assoc($res)){
                                        $id = $row['id'];
                                        $food = $row['food'];
                                        $price = $row['price'];
                                        $qty = $row['qty'];
                                        $total = $row['total'];
                                        $order_date = $row['order_date'];
                                        $status = $row['status'];
                                        $customer_name = $row['customer_name'];
                                        ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td>$<?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td>
                                            <?php
                                             if($status=="ordered"){
                                              echo "<p style='color:gray;'>".$status."</p>";
                                             }
                                             if($status=="ondelivery"){
                                                echo "<p style='color:blue;'>".$status."</p>";

                                             }if($status=="delivered"){
                                                echo "<p style='color:green;'>".$status."</p>";

                                             }if($status=="cancelled"){
                                                echo "<p style='color:red;'>".$status."</p>";

                                             }
                                            ?>
                                        </td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo SITEURL ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-sm btn-square btn-neutral"><i class="bi bi-pencil"></i></a>
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