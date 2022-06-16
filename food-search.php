<?php include('partials/menu.php') ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
         <!-- In other page we just pass the url of the page -->
         <?php
          if(isset($_POST['search'])){
          $search = mysqli_real_escape_string($conn,$_POST['search']);
          }else{
              header("location:".SITEURL);
          }
         ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
             $search = mysqli_real_escape_string($conn,$_POST['search']);
             // Sql query to get foods based on search keyword
             $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
             //execute the query
             $res = mysqli_query($conn,$sql);
             //count rows
             $count = mysqli_num_rows($res);
             // Check wether the query is executed or not
                 if($count>0){
                     // Food is available
                     while($row = mysqli_fetch_assoc($res)){
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
                                      <img src="<?php echo SITEURL; ?>/images/foods/<?php echo $image;?>" alt="<?php echo $image;?>" class="img-responsive img-curve">
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
                                    <a href="<?php echo SITEURL; ?>order.php" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                      <?php
                     }
                 }else{
                    echo "Food is not available";
                 }

            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials/footer.php') ?>