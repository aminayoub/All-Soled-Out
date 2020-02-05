<?php require("database.php"); 
      require("templates/header.php");
      require("templates/navigation.php");
?>

<?php
   if(isset($_POST['login'])){
            $username = $_POST['username'];
            $admin_password = $_POST['password'];
            
            $sql = "SELECT * FROM admin WHERE admin_name= '{$username}'";
            $res = mysqli_query($con, $res);
            
            $row = mysqli_fetch_array($res);
            $admin_password = $row['admin_pass'];
       
            if($password == $admin_password) {
                $_SESSION['username'] = $username;
                header("Location: admin.php");
                
            } else {
                echo '<div class="alert alert-danger" role="alert"><p><strong>Incorrect password</div>';
            }
            
            
                 
       
        }

?>

    <div class="container-fluid background">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <form action="admin_login.php" method="post" enctype="multipart/form-data" class="login-form">
                  <div class="form-group">
                    <label for="username">Admin Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Admin Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                  </div>
                  <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                  <div class="text-center">
                    <a href="login.php">Customer Login</a>
                  </div>
                </form>
            </div>
            </div>
    
        </div>

<?php require("templates/footer.php"); ?>