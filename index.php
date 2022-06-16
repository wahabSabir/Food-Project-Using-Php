<?php include('partials/menu.php') ?>
   <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
         <!-- Search foods and display foods by category selected -->
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
        if(isset($_SESSION['saved']))
        echo "<div class='text-center' style='color:green;'>".$_SESSION['saved']."</div>";
        unset($_SESSION['saved'])
    ?>
    <?php
        if(isset($_SESSION['order']))
        echo "<div class='text-center' style='color:red;'>".$_SESSION['order']."</div>";
        unset($_SESSION['order']);
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
             // get all data from database
             $sql = "SELECT * FROM tbl_category WHERE active='Yes' and featured='Yes'";
             //execute the query
             $res = mysqli_query($conn,$sql);
             // check whether the query is executed or not
             if($res==true){
                 $count = mysqli_num_rows($res);
                 if($count>0){
                     // Using while loop to get all data from database
                     While($row=mysqli_fetch_assoc($res)){
                         $id = $row['id'];
                         $title = $row['title'];
                         $image = $row['image_name'];
                         ?>
                            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                               <div class="box-3 float-container">
                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image; ?>" alt="<?php echo $image; ?>" class="img-responsive img-curve">
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                         <?php
                     }
                 }else{
                     echo "<div style='color:red;'>No Record Found</div>";
                 }
             }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
             // get all data from database
             $sql = "SELECT * FROM tbl_food WHERE active='Yes' and featured='Yes' LIMIT 6";
             //execute the query
             $res = mysqli_query($conn,$sql);
             // check whether the query is executed or not
             if($res==true){
                 $count = mysqli_num_rows($res);
                 if($count>0){
                     // Using while loop to get all data from database
                     While($row=mysqli_fetch_assoc($res)){
                         $id = $row['id'];
                         $title = $row['title'];
                         $description = $row['description'];
                         $price = $row['price'];
                         $image = $row['image_name'];
                         ?>
                           <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image;?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail"><?php echo $description; ?></p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                         <?php
                     }
                 }else{
                     echo "<div style='color:red;'>Food not Available</div>";
                 }
             }
            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials/footer.php') ?>