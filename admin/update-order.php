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
                            <h1 class="h2 mb-0 ls-tight">Update Orders</h1>

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
                            $sql = "SELECT * FROM tbl_order WHERE id=$id";
                            $res = mysqli_query($conn,$sql);
                            if($res==true){
                                $count = mysqli_num_rows($res);
                                if($count==1){
                                    $row = mysqli_fetch_assoc($res);
                                    $food = $row['food'];
                                    $price = $row['price'];
                                    $qty = $row['qty'];
                                    $total = $row['total'];
                                    $status = $row['status'];
                                    $customer_name = $row['customer_name'];
                                    $customer_contact = $row['customer_contact'];
                                    $customer_email = $row['customer_email'];
                                    $customer_address = $row['customer_address'];
                                }
                                else{
                                    // Redirect to Manage order Page
                                    $_SESSION['no-order'] = "No order Found";
                                    header("location:".SITEURL."admin/manage-order.php");
                                }
                                }
                                }else
                                {
                                    // Redirect to Manage order Page
                                    header("location:".SITEURL."admin/manage-order.php");
                                }
                        ?>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="food">Order Food</label>
                                    <input type="text" class="form-control" value="<?php echo $food; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="price">Order Price</label>
                                    <input type="text" class="form-control" value="$<?php echo $price; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="qty">Order Qty</label>
                                    <input type="number" name="qty" class="form-control" value="<?php echo $qty; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="status">Order status</label>
                                        <select class="form-select" name="status">
                                            <option <?php if($status=="ordered") {echo "selected";} ?> value="ordered">Ordered</option>
                                            <option <?php if($status=="ondelivery") {echo "selected";} ?> value="ondelivery">Ondelivery</option>
                                            <option <?php if($status=="delivered") {echo "selected";} ?> value="delivered">Delivered</option>
                                            <option <?php if($status=="cancelled") {echo "selected";} ?> value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="customer_name">Customer Name</label>
                                       <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="customer_contact">Customer Contact</label>
                                       <input type="text" name="customer_contact" class="form-control" value="<?php echo $customer_contact; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="customer_email">Customer Email</label>
                                       <input type="text" name="customer_email" class="form-control" value="<?php echo $customer_email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="customer_address">Customer Address</label>
                                       <textarea class="form-control" id="customer_address" name="customer_address" rows="2"><?php echo htmlspecialchars($customer_address); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--  row   -->
                            <input type="hidden" name="id" value="<?php echo $id;?>" >
                            <input type="hidden" name="price" value="<?php echo $price;?>" >
                            <button type="submit" name="submit" class="btn btn-primary">Update Order</button>
                        </form>
                    </div>
<?php
if(isset($_POST['submit'])){
 $id = $_POST['id'];
 $price = $_POST['price'];
 $qty = $_POST['qty'];
 $total = $price * $qty;
 $status = $_POST['status'];
 $customer_name = $_POST['customer_name'];
 $customer_email = $_POST['customer_email'];
 $customer_contact = $_POST['customer_contact'];
 $customer_address = $_POST['customer_address'];
//  Create query to update record
$sql2 = "UPDATE tbl_order SET qty='$qty',total='$total',status='$status',customer_name='$customer_name',customer_email='$customer_email',customer_contact='$customer_contact',customer_address='$customer_address' WHERE id=$id";
// Execute the query
$res2 = mysqli_query($conn,$sql2);
// Check wether the query is executed or not
if($res==true){
    $_SESSION['update-order'] = "Order Updated Successfuly";
    header("location:".SITEURL."admin/manage-orders.php");
}else{
    $_SESSION['update-error'] = "Failed to update Order";
    header("location:".SITEURL."admin/manage-orders.php");
}
}
?>
                </div>
            </div>
        </main>
   </div>