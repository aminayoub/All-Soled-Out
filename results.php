<?php require("database.php");
      require("templates/header.php");
      require("templates/navigation.php");
?>

<br>
     
<div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
              </ol>
            </div>
          </div>
     </div>
    
    <div class="col-lg-9">
        <div class="row">
             <?php
    
                if(isset($_POST['keyword'])){
                    $search = $_POST['search'];

                    $sql = "SELECT * FROM products WHERE name LIKE '%$search%' OR brand LIKE '%$search%' ";
                    $res = mysqli_query($con, $sql);
                
                    $count = mysqli_num_rows($res);
                
                    if($count == 0) {

                            echo 'No results found.';

                    } else {

                    while($row = mysqli_fetch_assoc($res)){
                            $product_id = $row['product_id'];
                            $name = $row['name'];
                            $price = $row['price'];
                            $image = $row['image'];
            ?>
            
          <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 products">
              <form method="post" action="products.php?add&id=<?php echo $product_id; ?>">
              <?php echo "<a href='info.php?pid=$product_id'>"; ?><img src="<?php echo $image; ?>" class="w-100 images" height="200px;"></a>
              <h5 class="text-center"><?php echo $name; ?></h5>
              <h5 class="text-center">Price: £<?php echo $price; ?></h5>

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
               
              <input type="hidden" name="name" value="<?php echo $name; ?>" />
              <input type="hidden" name="price" value="<?php echo $price; ?>" />
              <div class="text-center buttons">
                  <?php echo "<a href='info.php?pid=$product_id' class='btn btn-primary'>Info</a>";?>
                  <input type="submit" name="add_product" class="btn btn-success" value="Add to basket"/>
              </div>
          </div>
              </form>
        <?php } } }  ?>
          </div>
        </div>
    </div>
         
</div>

<?php require("templates/footer.php"); ?>