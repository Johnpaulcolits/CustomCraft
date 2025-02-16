<?php
session_start();
include_once "./php/config.php";

// session_start();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
  header("Location: login.php"); // Redirect unauthorized users
  exit();
}
$sql = mysqli_query($conn, "SELECT * FROM users WHERE usertype = '{$_SESSION['usertype']}'");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    // You can now use $row for admin-specific information
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustomCraft</title>
    <link rel="shortcut icon" href="./admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./assets/css/product.css"  /> 
  </head>
<body>
      
      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top" style="height: 82px;">
          <div class="container-fluid">
            <a class="navbar-brand" href="product.php">CustomCraft</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Shop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="customize.php">Create Your's</a>
                </li>

                <li class="nav-item">
                  <i class="fas fa-shopping-cart"></i>
                </li>

              
                  
                  <div class="profile-container">
          <div class="profile" onclick="toggleDropdown()">
              <img src="./php/images/<?php echo $row['img'] ?>" alt="Profile Picture" class="profile-pic">
              <span class="profile-name"><?php echo $row['fname'] ?></span>
          </div>
          <div id="dropdown" class="dropdown-content">
              <a href="#">Profile</a>
              <a href="#">Settings</a>
              <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
          </div>
      </div>
            

                
                      
              </ul>
            
            </div>
          </div>
        </nav>

<script>
function toggleDropdown() {
    var dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.closest('.profile')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};
</script>
      
<!--Home-->
<section id="home">
  <div class="container">
    <h5>NEW ARRIVALS</h5>
    <h1><span>Best Price</span> This Season</h1>
    <p>CustomCraft offers the best products for the most affordable prices</p>
    <button>Shop Now</button>
  </div>
</section>

    <!--Brand-->
    <section id="brand" class="container">
      <div class="row">
        <img src="./assets/img/back.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        <img src="./assets/img/back.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        <img src="./assets/img/back.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
        <img src="./assets/img/back.png" class="img-fluid col-lg-3 col-md-6 col-sm-12">
      </div>
    </section>

        <!--New-->
        <section id="new" class="w-100">
        <div class="row p-0 m-0">
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img src="./assets/img/back.png" class="img-fluid">
            <div class="details">
              <h2>Extreamly Awesome New Products</h2>
              <button class="text-uppercase">Shop Now</button>
            </div>
          </div>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img src="./assets/img/back.png" class="img-fluid">
            <div class="details">
              <h2>Extreamly Awesome New Products</h2>
              <button class="text-uppercase">Shop Now</button>
            </div>
          </div>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
            <img src="./assets/img/back.png" class="img-fluid">
            <div class="details">
              <h2>Extreamly Awesome New Products</h2>
              <button class="text-uppercase">Shop Now</button>
            </div>
          </div>
        </div>
        </section>

                <!--Featured-->
               <section id="featured" class="my-5 pb-5">
                <div class="container text-center mt-5 py-5">
                  <h3>Our Featured</h3>
                  <hr class="mx-auto hr-here">
                  <p>Here you can check out our featured products</p>
                </div>
                <div class="row mx-auto container-fluid">
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>

                </div>

               </section>


          <!--Sale-->
          <section id="banner" class="my-5 py-5">
            <div class="container"> 
                <h4>MID SEASON'S SALE</h4>
                <h1>Autumn Collection <br> UP to 30% OFF</h1>
                <button class="text-uppercase">shop now</button>
            </div>
          </section>

            <!--shirt-->
            <section id="featured" class="my-5 pb-5">
                <div class="container text-center mt-5 py-5">
                  <h3>Dresses</h3>
                  <hr class="mx-auto">
                  <p>Here you can check out our amazing clothes</p>
                </div>
                <div class="row mx-auto container-fluid">
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>
                  <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                    <img src="./assets/img/back.png" class="img-fluid mb-3">
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                      <h5 class="p-name">Shirt</h5>
                      <h4 class="p-price">₱133.3</h4>
                      <button class="buy-btn">BUY NOW</button>
                  </div>

                </div>

               </section>


    <!-- <footer class="mt-5 py-5">
        <div class="row">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
              <img src="" >
              <p class="pt-3">We provide the best products for the most affordable prices</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
              <h5 class="pb-2">Featured</h5>
              <ul class="text-uppercase">
              <li><a href="">men</a></li>
              <li><a href="">women</a></li>
              <li><a href="">boys</a></li>
              <li><a href="">girls</a></li>
              <li><a href="">new arrivals</a></li>
              <li><a href="">clothes</a></li>
              </ul>
            </div>
        </div>

        <div class="footer-one col-lg-3 col-md-6 col-sm-12">
    <h5 class="pb-2">Contact Us</h5>
    <div >
      <h6 class="text-uppercase">Address</h6>
      <p>1234 Street, City</p>
    </div>
    <div >
      <h6 class="text-uppercase">Phone</h6>
      <p>1234 567 8910</p>
    </div>
    <div >
      <h6 class="text-uppercase">Email</h6>
      <p>info@gmail.com</p>
    </div>
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Instagram</h5>
        <div class="row">
        <img src="./assets/img/footer1.png" class="img-fluid w-25 h-100 m-2">
        </div>
    </div>
        </div>
    </footer> -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>