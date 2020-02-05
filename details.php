<?php require("database.php"); 
      require("templates/header.php");
      require("templates/navigation.php");
?>

<div class="container-fluid">

     <br>
      <div class="row">
        <div class="col-lg-12">
          <div aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">My Details</li>
              </ol>
            </div>
          </div>
     </div>
    
      <?php
        $id = $_SESSION['customer_id'];
        $sql = "SELECT * FROM customers WHERE customer_id =$id";
        $res = mysqli_query($con, $sql);
    
        while($row = mysqli_fetch_assoc($res)){
            $customer_id = $row['customer_id'];
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];
            $email = $row['email'];
            $username = $row['username'];
            $image = $row['avatar'];
        }
    
         if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['profile'])){
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                
                $image = $_FILES['avatar']['name'];
                $imagepath = $_FILES['avatar']['tmp_name'];
                $location = 'media/';
                move_uploaded_file($imagepath, $location.$image);
                
                $sql = "UPDATE customers SET first_name='$firstname', last_name='$lastname', username='$username', email='$email', avatar='$image' WHERE customer_id='$id'";
                
                $result = mysqli_query($con, $sql);
                header("Location: details.php");
                
            }
         }
    
    ?>
    
    <?php
    
        $alert = "";
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['password'])){
                $pass = $_POST['pass'];
                $confpass = $_POST['confpass'];
                
                if ($pass != $confpass){
                $alert = "<div class='alert alert-danger' role='alert'>Incorrect password confirmation</div>";
                } else {

                $encrypt = password_hash($pass, PASSWORD_BCRYPT);
                $sql= "UPDATE customers SET password='$encrypt'";

                $res = mysqli_query($con, $sql);

                }
                
            }
         }
    
    
    ?>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    Profile Information
                </div>
                <div class="card-body">
                <?php 
                    if(isset($image)){
                    echo "<img src='media/$image' class='w-100'>";
                    } else {
                        echo "<b>No image uploaded</b>";
                    }
                    
                ?>
                <p>
                    <br>
                    Name: 
                 <?php echo $firstname;
                       echo " ";
                       echo $lastname;
                 ?>
                </p>
                <p>Username: <?php echo $username; ?></p>
                <p>Email: <?php echo $email; ?></p>
                </div>
            </div>
        </div>
        
     <div class="col-lg-9">
        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                Edit Profile
                </div>
            <div class="card-body">
                <form action="details.php" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="firstname">First Name</label>
                          <input type="text" name="firstname" class="form-control" placeholder="<?php echo $firstname; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="lastname">Last Name</label>
                          <input type="text" name="lastname" class="form-control" placeholder="<?php echo $lastname; ?>" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="<?php echo $username; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="<?php echo $email; ?>" required>
                      </div>
                       <div class="form-group">
                        <label for="avatar">Select an avatar</label>
                        <input type="file" name="avatar" class="form-control-file">
                      </div>
                      <button type="submit" name="profile" class="btn btn-primary text-center">Update Profile</button>
                    </form>
                </div>
            </div>
            <br>
        </div>
        
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                    if($alert != ""){
                        echo $alert;
                    }

                ?>
            <div class="card">
                <div class="card-header">
                Change Password
                </div>
            <div class="card-body">
                <form action="details.php" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                
                        <div class="form-group col-md-6">
                          <label for="firstname">New password</label>
                          <input type="password" name="pass" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="password">Confirm password</label>
                          <input type="password" name="confpass" class="form-control" required>
                        </div>
                      </div>
                      <button type="submit" name="password" class="btn btn-primary text-center">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</div>

<?php require("templates/footer.php"); ?>