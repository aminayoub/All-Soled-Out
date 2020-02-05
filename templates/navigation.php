  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2f4870;">
          <a class="navbar-brand" href="index.php"> <img src="media/logo1.png" width="60" height="60" class="d-inline-block align-top rounded-circle" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="products.php">Products</a>
              </li>
              <?php
                if(!isset($_SESSION['username'])){
                    echo ' <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                          </li>';
                }
                ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  My Account
                </a>
                <?php
                  if(isset($_SESSION['username'])){
                      echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #2f4870;">
                              <a class="dropdown-item" href="details.php">My Details</a>
                              <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>';
                  } else {
                      echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #2f4870;">
                              <a class="dropdown-item" href="login.php">Login</a>
                            </div>';
                  }
                  ?>
                
              </li>
            </ul>
            <a class="nav-item" style="margin-right: 20px;"> 
             <i class="fas fa-shopping-basket"></i>
            <?php
              if(isset($_SESSION['basket'])){
              echo $number = count($_SESSION['basket']);
              } else {
                  echo 0;
              }
              ?> 
                Items in Basket</a>
            <form action="results.php" method="post" class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" name="search" type="search" placeholder="Nike, Adidas, etc" aria-label="Search">
              <button class="btn btn-primary my-2 my-sm-0" name="keyword" type="submit">Search</button>
            </form>
          </div>
    </nav>