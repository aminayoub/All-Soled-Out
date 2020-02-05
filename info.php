<?php require("database.php"); 
?>

<?php require("templates/header.php"); 
      require("templates/navigation.php");
?>

<div class="container-fluid">
    <br>
    
     <div class="row">
        <div class="col-lg-12">
          <div aria-label="breadcrumb">
              <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item"><a href="products.php">Products</a></li>
               <li class="breadcrumb-item active" aria-current="page">Product Information</li>
              </ol>
            </div>
          </div>
     </div>
    
    <div class="row">
        <div class="col-lg-3">
               <h5 class="text-center">Basket</h5>
        <hr>
        <div class="card">
        <div class="card-body">
            <ul>
                 <?php 
                    if(!empty($_SESSION['basket'])){
                        $total = 0;
                        foreach($_SESSION['basket'] as $key => $row){
                    ?>
                <li style="padding: 5px;"><?php echo $row['name'];?> x<?php echo $row['quantity']; ?>
                <a href="products.php?action=delete&id=<?php echo $row['id']; ?>">
                    <button class="btn-danger" style="position: absolute; right: 0; margin-right: 5px;">Delete</button>
                </a>
                </li>
                 <?php 
                    //calculates the total of a single product based on the quantity and price 
                    $total = $total + ($row['quantity'] * $row['price']);
                    }   
                 ?>
            </ul>
            <hr>
            <!-- Number format function to display the grand total with the correct decimal value-->
            <p class="text-center">Total: £<?php echo number_format($total, 2); ?></p>
            <a href="checkout.php" class="btn btn-primary btn-block">Checkout</a>
            <?php } 
            else { 
                echo "<p class='text-center'><div class='alert alert-primary' role='alert'>
                          Your basket is empty!
                        </div></p>";
            }
            ?>
        </div>
        </div>
        </div>
        
        <div class="col-lg-9">
            <div class="row">
                <?php
                    if(isset($_GET['pid'])){
                    $pid = $_GET['pid'];
                    }
                    $sql = "SELECT * FROM products WHERE product_id = $pid";
                    $res = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($res)){
                ?>
                <div class="col-lg-5">
                <img src="<?php echo $row['image']; ?>" class="w-100">
                </div>
                <div class="col-lg-4">
                <h1 class="text-center"><?php echo $row['name']; ?></h1>
                          <h3 class="text-center">Price: £<?php echo $row['price']; ?></h5>
                          <h5 class="text-center"><?php echo $row['description']; ?></h4>
                          <button type="button" class="btn btn-secondary btn-block" data-toggle="tooltip" data-placement="right" title="<?php echo $row['product_fact']; ?>">
                              Hover here for a fact
                          </button>
                </div>
                
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require("templates/footer.php"); ?>