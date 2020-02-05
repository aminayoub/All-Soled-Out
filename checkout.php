<?php require("database.php"); 
?>
<?php require("templates/header.php"); 
      require("templates/navigation.php");

      if(!isset($_SESSION['customer_id'])){
          header("Location: login.php");
      }
?>

<div class="container-fluid">
    
    <br>
      <div class="row">
        <div class="col-lg-12">
          <div aria-label="breadcrumb">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="products.php">Products</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
        }
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['purchase'])){
                echo "<div class='alert alert-success' role='alert'>
                      Purchase successful!</div>";
            }
        }
    
    ?>
   
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3 class="text-center">Billing Information</h3>
            <form action="checkout.php" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-lg-6">
                      <label for="firstname">First Name</label>
                      <input value="<?php echo $firstname; ?>" type="text" class="form-control" placeholder="Enter your first name" disabled>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="lastname">Last Name</label>
                      <input value="<?php echo $lastname; ?>" type="text" class="form-control" placeholder="Enter your last name" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input value="" type="text" name="address" class="form-control" placeholder="Northampton Square" required>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-lg-6">
                      <label for="city">City</label>
                      <input value="" type="text" name="city" class="form-control" placeholder="London" required>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="postcode">Postcode</label>
                      <input value="" type="text" name="postcode" class="form-control" placeholder="EC1V 0HB" required>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="cardname">Cardholder name</label>
                    <input value="" type="text" name="cardname" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="cardnumber">Card number</label>
                    <input value="" type="text" name="cardnumber" class="form-control" required>
                </div>
                <button type="submit" name="purchase" class="btn btn-primary btn-block">Confirm Purchase</button>
            </form>
        </div>
        
           <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
               <h3 class="text-center">Order Information</h3>
                <?php 
               
                     if(isset($_GET['input']) == 'delete'){
                        foreach($_SESSION['basket'] as $key => $row){
                            if($row['id'] == $_GET['id']){
                                unset($_SESSION['basket'][$key]);
                            }
                        }
                        //returns the array values 
                        $_SESSION['basket'] = array_values($_SESSION['basket']);
                    }
        
                    if(!empty($_SESSION['basket'])){
                    $total = 0;
                    foreach($_SESSION['basket'] as $key => $row){
                ?>
               
                <div class="text-center">
                    <p><b><?php echo $row['name']; ?></b></p>
                    <p>Quantity: <?php echo $row['quantity']; ?></p>
                    <p>Size: <?php echo $row['size']; ?></p>
                    <p>Price: £<?php echo $row['price']; ?></p>
                     <a href="checkout.php?input=delete&id=<?php echo $row['id']; ?>">
                            <button class="btn-danger">Delete</button>
                            <hr>
                     </a>
                </div>
               
                <?php 
                    $total = $total + ($row['quantity'] * $row['price']);
                }   
                ?>
               
               <p class="text-center"><b>Total: £<?php echo number_format($total, 2); ?></b></p>
                
                    <?php }
                        else {
                            header("Location: products.php");
                        }
                    ?>
            </div>
    </div>
</div>

<?php require("templates/footer.php"); ?>