<?php require("database.php"); 
?>
<?php require("templates/header.php"); 
      require("templates/navigation.php");
?>
    
      
    <br>
    <div class="container-fluid">
     <div class="jumbotron jumbotron-fluid jumbo">
        <div class="container">
            <h1 class="display-4">
                   <?php
                if(isset($_SESSION['customer_id'])){
                    echo "Hello ".$_SESSION['first_name'].". Welcome to All Sole'd Out.";
                } else {
            ?>
                Welcome to All Sole'd Out
            <?php } ?>
            </h1>
            <p class="lead">Your favourite new destination for high quality trainers and sneakers.</p>
        </div>
    </div>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="media/showcase.jpg" class="d-block w-100 img-fluid" alt="Responsive image" height="900px">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A leading destination for footwear</h5>
                    <p>With 120 flagship stores across the UK, we are aiming to provide our high quality footwear worldwide.</p>
                </div>
            </div>
            <div class="carousel-item">
              <img src="media/showcase2.jpg" class="d-block w-100 img-fluid" alt="Responsive image" height="900px">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A varied selection</h5>
                    <p>We are not limited to one brand, we keep up to date with the latest footwear.</p>
                </div>
            </div>
            <div class="carousel-item">
              <img src="media/showcase3.jpg" class="d-block w-100 img-fluid" alt="Responsive image" height="900px">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A defined quality</h5>
                    <p>We ensure that our footwear is manufactured ethically with the highest quality materials.</p>
                </div>
            </div>
      </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
    </div>
    <br>
    </div>
      
    <div class="container-fluid">
        <div class="col-lg-12">
             <h2 class="text-center">Recently Added</h2>
        <div class="row">
              <?php 
                  $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 3";
                  $res = mysqli_query($con, $sql);
                  while($row = mysqli_fetch_assoc($res)) { 
              ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <img src="<?php echo $row['image']; ?>" class="w-100" height="300px;">
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
    
<?php require("templates/footer.php"); ?>