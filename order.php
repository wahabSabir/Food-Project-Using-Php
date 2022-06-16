<?php include('partials/menu.php') ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <?php
            if(isset($_GET['food_id'])){
                $food_id = $_GET['food_id'];
                $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image = $row['image_name'];
                }
            }else{
                header("location:".SITEURL);
            }
            ?>
            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image!=""){
                            ?>
                            <img src="<?php echo SITEURL; ?>images/foods/<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }else{
                            echo "<div style='color:red;'>Image not Found</div>";
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="customer_name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="customer_contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="customer_email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="customer_address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
<?php
if(isset($_POST['submit'])){
   $food = $_POST['food'];
   $price = $_POST['price'];
   $qty = $_POST['qty'];
   $total = $price * $qty;
   date_default_timezone_set("Asia/Karachi");
   $order_date = date("Y-m-d h:i:sa");
   $status = "Ordered";
   $customer_name = $_POST['customer_name'];
   $customer_contact = $_POST['customer_contact'];
   $customer_email = $_POST['customer_email'];
   $customer_address = $_POST['customer_address'];
   // create query to store data in database
   $sql = "INSERT INTO tbl_order SET
           food='$food',
           price='$price',
           qty='$qty',
           total='$total',
           order_date='$order_date',
           status='$status',
           customer_name='$customer_name',
           customer_contact='$customer_contact',
           customer_email='$customer_email',
           customer_address='$customer_address'
        ";
    // Execute Query
    $res = mysqli_query($conn,$sql);
    // Check wether the query is executed or not
    if($res==true){
      // Query executed and order Saved
      $_SESSION['saved'] = "Order Submit Successfuly";
      header("location:".SITEURL);
    }else{
      // Failed to saved order
      $_SESSION['order'] = "Order is not submit";
      header("location:".SITEURL);
    }
}
?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php include('partials/footer.php') ?>