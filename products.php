<?php require("database.php"); 
?>

<?php require("templates/header.php"); 
      require("templates/navigation.php");
?>

<?php

    $array_id = array();

    //matches the ID number of the product with array keys
    if(isset($_POST['add_product'])){
        if(isset($_SESSION['basket'])){
            //counts the number of items in the basket
            $number = count($_SESSION['basket']);
            $array_id = array_column($_SESSION['basket'], 'id');
            
            //if the item is not in the array, it gets added to the basket, otherwise the quantity is updated
            if (!in_array($_GET['id'], $array_id)){
                  $_SESSION['basket'][$number] = array
                (
                    'id' => $_GET['id'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['quantity'],
                    'size' => $_POST['size']
                );
            }
            else {
                //updates the quantity in the basket 
                for ($i = 0; $i < count($array_id); $i++){
                    if($array_id[$i] == $_GET['id']){
                        $_SESSION['basket'][$i]['quantity'] += $_POST['quantity'];
                    }
                }
            }
        } else {
            $_SESSION['basket'][0] = array
                (
                    'id' => $_GET['id'],
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'quantity' => $_POST['quantity'],
                    'size' => $_POST['size']
                );
        }
    }

    if(isset($_GET['input']) == 'delete'){
        foreach($_SESSION['basket'] as $key => $row){
            if($row['id'] == $_GET['id']){
                unset($_SESSION['basket'][$key]);
            }
        }
        //returns the array values 
        $_SESSION['basket'] = array_values($_SESSION['basket']);
    }

?>
    <br>
     
     <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
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
                <li style="padding: 10px;"><?php echo $row['name'];?> x<?php echo $row['quantity']; ?>
                <a href="products.php?input=delete&id=<?php echo $row['id']; ?>" class="btn btn-outline-danger" style="position: absolute; right: 0; margin-right: 5px;">
                    Delete
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
        
        <br>
        
        <h5 class="text-center">Filter Brands</h5>
        <hr>
        <ul class="list-group">
            <?php
            $filter = "SELECT DISTINCT brand FROM products";
            $res = mysqli_query($con, $filter);
                
            while($row = mysqli_fetch_assoc($res)) { 
            ?>
                
            <li class="list-group-item">
                
                <label><input type="checkbox" class="selector brand" value="<?php echo $row['brand']; ?>"> <?php echo $row['brand']; ?></label>
                
            </li>
            <?php } ?>
        </ul>
        
    </div>
    
    <div class="col-lg-9">
        <div class="row">
             <?php 
                  $sql = "SELECT * FROM products";
                  $res = mysqli_query($con, $sql);
                  while($row = mysqli_fetch_assoc($res)) { 
                  $product_id = $row['product_id'];
              ?>
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 products">
              <form method="post" action="products.php?add&id=<?php echo $row['product_id']; ?>">
              <?php echo "<a href='info.php?pid=$product_id'>"; ?><img src="<?php echo $row['image']; ?>" class="w-100 images" height="200px;"></a>
              <h5 class="text-center"><?php echo $row['name']; ?></h5>
              <h5 class="text-center">Price: £<?php echo $row['price']; ?></h5>

                <div class="row">
                    <label for="quantity" class="col-6 col-form-label">Quantity</label>
                    <div class="col-6">
                        <input type="number" class="form-control" name="quantity" value="1">
                    </div>
                    <label for="size" class="col-6 col-form-label">Size</label>
                    <div class="col-6">
                        <input type="number" class="form-control" name="size" value="5">
                    </div>
                </div>
               
              <input type="hidden" name="name" value="<?php echo $row['name']; ?>" />
              <input type="hidden" name="price" value="<?php echo $row['price']; ?>" />
              <div class="text-center buttons">
                  <?php echo "<a href='info.php?pid=$product_id' class='btn btn-primary'>Info</a>";?>
                  <input type="submit" name="add_product" class="btn btn-success" value="Add to basket"/>
              </div>
          </div>
              </form>
             <?php } ?>
          </div>
        </div>
        </div>
    </div>
    <br>

</div>
   
<?php require("templates/footer.php"); ?>