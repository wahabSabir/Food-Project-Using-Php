<?php include('partials/menu.php') ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
             // get all data from database
             $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
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
                                    <?php
                                      if($image!=""){
                                    ?>
                                      <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                      }else{
                                          echo "<div style='color:red;'>Image not Available</div>";
                                      }
                                    ?>
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
                     echo "<div style='color:red;'>Food not available</div>";
                 }
             }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials/footer.php') ?>