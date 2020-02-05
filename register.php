<?php require("database.php"); ?>
<?php require("templates/header.php"); 
      require("templates/navigation.php");
?>

<?php 

    $alert = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['register'])){
        
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confpassword = $_POST['confpassword'];
            
            $image = $_FILES['file']['name'];
            $imagepath = $_FILES['file']['tmp_name'];
            $location = 'media/';
            move_uploaded_file($imagepath, $location.$image);

            if ($password != $confpassword){
                $alert = "<div class='alert alert-danger' role='alert'>Incorrect password confirmation</div>";
            } else {
            
            $encrypt = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO customers (first_name, last_name, username, email, password, avatar) VALUES ('{$firstName}', '{$lastName}', '{$username}', '{$email}', '{$encrypt}', '{$image}')";
            
            $result = mysqli_query($con, $query);
                
                
            }
               
        }
    }
?>

        <div class="container-fluid background">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <?php
                    if($alert != ""){
                        echo $alert;
                    }
                    
                    ?>
                <form action="register.php" method="post" enctype="multipart/form-data" class="register-form">
                  <div class="form-group">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" name="firstName" placeholder="Enter your first name" required>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" name="lastName" placeholder="Enter your last name" required>
                  </div>
                  <div class="form-group">
                    <label for="lastName">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter your username" required>
                  </div>
                  <div class="form-group">
                    <label for="avatar">Select an avatar</label>
                    <input type="file" name="file" class="form-control-file">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="customer@address.com" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter a password" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control" name="confpassword" placeholder="Confirm your password" required>
                  </div>
                  <input name="register" type="submit" class="btn btn-primary btn-block" value="Register">
                  <div class="text-center">
                    <a href="login.php">Login</a>
                    </div>
                </form>
            </div>
            </div>
    
        </div>

<?php require("templates/footer.php"); ?>