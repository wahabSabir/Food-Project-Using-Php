<?php include('../config/constants.php'); ?>
<link rel="stylesheet" href="../css/adminstyle.css">
<link rel="stylesheet" href="../css/loginform.css">
<!-- Login Form -->
<div class="login-form py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="card shadow-sm">
          <span class="shape"></span>
          <div class="card-header text-center bg-transparent">
            <i class="fas fa-user-circle"></i>
            <h2>Login Form</h2>
          </div>
          <div class="card-body py-4">
            <form action="" method="POST">
              <?php
                if(isset($_SESSION['login-error']))
                echo "<div style='color:red;'>".$_SESSION['login-error']."</div>";
                unset($_SESSION['login-error'])
              ?>
              <?php
                if(isset($_SESSION['login-check']))
                echo "<div style='color:red;'>".$_SESSION['login-check']."</div>";
                unset($_SESSION['login-check'])
              ?>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control shadow-none" name="username" placeholder="Enter Username">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                 <input type="password" class="form-control shadow-none" name="password" placeholder="Enter Password">
              </div>
              <div class="form-group mt-3">
                <button type="submit" name="submit" class="btn col-12">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Login Form -->
<?php
if(isset($_POST['submit'])){
  // Get the data from database
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  // Create query to get data from database
  $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
  // Execute Query
  $res = mysqli_query($conn,$sql);
  //Check whether the value in database or not
  if($res==true){
      $count = mysqli_num_rows($res);
      if($count==1){
       $_SESSION['login'] = "Admin Login Successfuly";
       // Check whether the user is login or not
       $_SESSION['user'] = $username;
       header("location:".SITEURL."admin/index.php");
      }else{
        $_SESSION['login-error'] = "Invalid Username or Passowrd";
        header("location:".SITEURL."admin/login.php");
      }
  }
}
?>