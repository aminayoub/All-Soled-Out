<?php require("database.php"); ?>
<?php require("templates/header.php"); 
      require("templates/navigation.php");
?>

<?php

        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $query = "SELECT * FROM customers WHERE username= '{$username}'";
            $result = mysqli_query($con, $query);
            
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)){
                    $customer_id = $row['customer_id'];
                    $first_name = $row['first_name'];
                    $email = $row['email'];
                    if(password_verify($password, $row['password'])){
                        $_SESSION['customer_id'] = $customer_id;
                        $_SESSION['first_name'] = $first_name;
                        $_SESSION['email'] = $email; 
                        $_SESSION['username'] = $username;
                        header("Location: index.php");
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Incorrect details</div>";
                    }
                }
            }
        }

            
    

?>
        
        <div class="container-fluid background">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <form action="login.php" method="post" enctype="multipart/form-data" class="login-form">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                  </div>
                  <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                  <div class="text-center">
                    <a href="register.php">New member? Register here</a>
                  </div>
                  <div class="text-center">
                    <a href="admin_login.php">Admin Login</a>
                  </div>
                </form>
            </div>
            </div>
    
        </div>
    
<?php require("templates/footer.php"); ?>