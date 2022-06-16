<?php include('partials/menu.php') ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
             // get all data from database
             $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                     echo "<div style='color:red;'>Category not Available</div>";
                 }
             }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php include('partials/footer.php') ?>