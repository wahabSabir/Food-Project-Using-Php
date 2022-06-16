<?php include('partials/menu.php') ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
         <?php
         // Check wether the id is pass or not
         if(isset($_GET['category_id'])){
           $category_id = $_GET['category_id'];
           // create query to get title based on category_id
           $sql = "SELECT title FROM tbl_category WHERE id='$category_id'";
           // execute query
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            $category_title = $row['title'];
           }
         else{
             echo "No record found";
         }

         ?>
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            // Create Query to get food based on category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id='$category_id'";
            // Execute query
            $res2 = mysqli_query($conn,$sql2);
            // count rows in databse
            $count2 = mysqli_num_rows($res2);
            //Check wether food is available or not
            if($count2>0){
             // Using while loop to get all data from database
             While($row2=mysqli_fetch_assoc($res2)){
                $id = $row2['id'];
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $image = $row2['image_name'];
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
   ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include('partials/footer.php') ?>