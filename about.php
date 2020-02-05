<?php require("database.php"); 
    
?>
<?php require("templates/header.php"); 
      require("templates/navigation.php");
?>
      
    <br>
     <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      
      <div class="container">
          <div class="row justify-content-center">
            <h1>About Us</h1>
            <h4 class="text-center">Established in 2015, we began distributing a range of sneakers from City, University of London's campus. </h4>
            <h4 class="text-center">Year on year, we have grown rapidly and have continued to establish relationships with high quality brands.</h4>
          </div>
      </div>
      <hr>
      
      <div id="cover">
      </div>
      
      <div class="container-fluid">
        <h1 class="text-center">Our Values</h1>
          <hr>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
             <h3 class="text-center">Integrity</h3>
                <div class="text-center">
                <i class="fas fa-handshake values"></i>
                </div>
                <p>We say exactly what we will do, and act on it. We also ensure to take corporate responsibility by delivering and manufacturing products with recyclable materials.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
             <h3 class="text-center">Customer-first</h3>
                <div class="text-center">
                <i class="fas fa-users values"></i>
                </div>
                <p>We put the customers' needs first. And also ensure that we are knowledgable about the industry that we operate in.</p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
             <h3 class="text-center">Ambitious</h3>
                <div class="text-center">
                <i class="fas fa-star values"></i>
                </div>
                <p>We anticipate changing trends, and adapt to them. Year on year we also aim to set new targets and stay out of our comfort zone.</p>
            </div>
          </div>
      </div>
      <hr>
      
      <div id="cover2">
      </div>
      
      <div class="container-fluid">
        <h1 class="text-center">Our Key Brands</h1>
          <hr>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                
             <div class="text-center">
                  <img src="media/nike-logo.png" class="rounded" alt="..." height="150px;" width="200px;">
             </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                
             <div class="text-center">
                  <img src="media/adidas.png" class="rounded" alt="..." height="150px;" width="200px;">
             </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                
              <div class="text-center">
                  <img src="media/vans.jpg" class="rounded" alt="..." height="150px;" width="200px;">
             </div>
            </div>
          </div>
      </div>
      
      <hr>
      
       <div class="container-fluid">
        <h1 class="text-center">Some inspiration for you..</h1>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/Ahz9kZGGf9c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                  <br>
              </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe width="560" height="315" src="https://www.youtube.com/embed/a1FIN_nTlzQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              </div>
           </div>
      </div>

<?php require("templates/footer.php"); ?>