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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['product'])){
            $prodname = $_POST['name'];
            $brand = $_POST['brand'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $fact = $_POST['fact'];
            
            $image = $_FILES['file']['name'];
            $imagepath = $_FILES['file']['tmp_name'];
            $location = 'media/';
            move_uploaded_file($imagepath, $location.$image);
            
            $sql = "INSERT INTO products (name, brand, image, price, description, product_fact) VALUES ('{$prodname}', '{$brand}', '".$location.$image."', '{$price}', '{$description}', '{$fact}')";
            
            $res = mysqli_query($con, $sql);
            header("Location: admin.php");
            
        }
        
        
    }

?>

<div class="container-fluid">
    <br>
    <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h3 class="text-center">New Product Information</h3>
              <div class="card">
                  <div class="card-body">
            <form action="admin.php" method="post" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-lg-6">
                      <label for="prodname">Product Name</label>
                      <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="brand">Brand Name</label>
                      <input type="text" name="brand" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" name="file" class="form-control-file" required>
                  </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="fact">Product Fact</label>
                    <input type="text" name="fact" class="form-control" required>
                </div>
                <button type="submit" name="product" class="btn btn-primary btn-block">Insert Product</button>
            </form>
              </div>
              </div>
        </div>
        
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h3 class="text-center">Products List</h3>
            <div class="card">
            <?php 
                  $sql = "SELECT * FROM products";
                  $res = mysqli_query($con, $sql);
                    ?>
            <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Product Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Brand</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($res)) {
                            $product_id = $row['product_id'];
                            $image = $row['image'];
                    echo "<tr>
                      <td>".$row['name']."</td>
                      <td>".$row['price']."</td>
                      <td>".$row['brand']."</td>
                      <td>
                      <a href='edit.php?edit={$product_id}'>Edit</a>
                      <a class='btn btn-danger' href='admin.php?remove={$product_id}' style='margin-left: 30px;' role='button'><i class='fas fa-times-circle'></i></a></td>
                    </tr>";
                    }
                      
                    ?>
                  </tbody>
                </table>
            </div>
        </div>
        
        <?php
              if(isset($_GET['remove'])){
                        
                    $remove = $_GET['remove'];
                    $sql = "DELETE FROM products WHERE product_id = {$remove}";
                    unlink($image);
                    $res = mysqli_query($con, $sql);

                    header("location: admin.php");
                        
                }
        
        ?>
    
    </div>
</div>

<?php require("templates/footer.php"); ?>
