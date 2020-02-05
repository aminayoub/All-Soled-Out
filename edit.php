<?php require("database.php"); ?>
<?php require("templates/header.php"); ?>

     <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2f4870;">
         <a class="navbar-brand" href=""> 
         <img src="media/logo1.png" width="30" height="30" class="d-inline-block align-top rounded-circle" alt="">
             Admin Tool
         </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="admin.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
    </nav>

<?php

    if(isset($_GET['edit'])){
        $product_id = $_GET['edit'];
        $sql = "SELECT * FROM products WHERE product_id = $product_id";
        $res = mysqli_query($con, $sql);
    }

    while($row = mysqli_fetch_assoc($res)){
        $name = $row['name'];
        $brand = $row['brand'];
        $image = $row['image'];
        $price = $row['price'];
        $desc = $row['description'];
        $fact = $row['product_fact'];
    }

?>

<?php

    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $brand = $_POST['brand'];
        $price = $_POST['price'];
        $desc = $_POST['description'];
        $fact = $_POST['fact'];
        
        $image = $_FILES['image']['name'];
        $imagepath = $_FILES['image']['tmp_name'];
        $location = 'media/';
        move_uploaded_file($imagepath, $location.$image);
        
        $sql = "UPDATE products SET name='$name', brand='$brand', image='".$location.$image."', price='$price', description='$desc', product_fact='$fact' WHERE product_id=$product_id ";
        $res = mysqli_query($con, $sql);
        
        header("Location: admin.php");
        
    }


?>

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <h3 class="text-center">Product Information</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-row">
                <div class="form-group col-lg-6">
                      <label for="name">Product Name</label>
                      <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group col-lg-6">
                      <label for="brand">Brand Name</label>
                      <input type="text" name="brand" class="form-control" value="<?php echo $brand; ?>" required>
                </div>
                </div>
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3" required><?php echo $desc; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="fact">Product Fact</label>
                    <input type="text" name="fact" class="form-control" value="<?php echo $fact; ?>" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary btn-block">Edit Product</button>
            </form>
         </div>
        </div>
    </div>
</div>

<?php require("templates/footer.php"); ?>
