<?php

session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
}


$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql) > 0){
  $row = mysqli_fetch_assoc($sql);
}
include_once "php/config.php";

// Get the unique_id of the logged-in user
$unique_id = $_SESSION['unique_id'] ?? null;

// Initialize cart count
$cart_count = 0;

// Query the cart count for the logged-in user
if ($unique_id) {
$sql = "SELECT COUNT(DISTINCT product_id) as total_items FROM cart WHERE unique_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $unique_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$cart_count = $data['total_items'] ?? 0;
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .products img{
            width: 100%;
            height: auto;
            box-sizing: border-box;
            object-fit: cover;
        }
        .pagination a{
            color: coral;
        }
        .pagination  li:hover a{
            color: #fff;
            background-color: coral;
        }
       .cart-icon{
        color: black;
       }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/imgs/icon-logo.png" type="image">
</head>
<body>
        <!--Navbar--> 
    <nav class="navbar navbar-expand-lg navbar-light py-3 fixed-top" style="background-color: #02766f;">
        <div class="container">
          <img src="assets/imgs/icon-logo.png" class="img-logo">
          <h2 class="brand">CustomCraft</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
              <li class="nav-item">
              <a href="cart.php"><div>
    <i class="fas fa-shopping-bag  cart-icon" id="cart-icon" ></i>
    <span id="cart-count">0</span>
          </div></a>
              </li>   
            </ul>

             <!-- Profile Section -->
             <div class="d-flex align-items-center profile-section">
    <img 
      src="php/images/<?php echo $row['img']; ?>" 
      alt="Profile" 
      class="rounded-circle profile-image me-2"
    />
    
  </div>

</div>
          </div>
          
        </div>
      </nav>

      <!--Featured-->
      <section id="featured" class="my-5 py-5">
        <div class="container  mt-5 py-5">
          <h3>Our Products</h3>
          <hr >
          <p>Here you check our products</p>
        </div>
        <div class="row mx-auto container">
          <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/f1.png" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Jersey</h5>
            <h4 class="p-price">₱199</h4>
            <button class="buy-btn">Buy Now</button>
          </div>
          <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/f1.png" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Jersey</h5>
            <h4 class="p-price">₱199</h4>
            <button class="buy-btn">Buy Now</button>
          </div>
          <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/f1.png" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Jersey</h5>
            <h4 class="p-price">₱199</h4>
            <button class="buy-btn">Buy Now</button>
          </div>
          <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="assets/imgs/f1.png" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Sports Jersey</h5>
            <h4 class="p-price">₱199</h4>
            <button class="buy-btn">Buy Now</button>
          </div>
        </div>
        <div class="row mx-auto container-fluid">
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
          </div>
          <div class="row mx-auto container-fluid">
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
          </div>
          <div class="row mx-auto container-fluid">
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>
            <div onclick="window.location.href='single.product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img src="assets/imgs/f1.png" class="img-fluid mb-3">
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h5 class="p-name">Sports Jersey</h5>
              <h4 class="p-price">₱199</h4>
              <button class="buy-btn">Buy Now</button>
            </div>

            <nav area-label="page navigation">
                <ul class="pagination mt-5">
                    <li class="page-item"><a href="#" class="page-link">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </nav>
          </div>

      </section>


            <!--Footer-->
      <footer class="mt-5 py-5">
        <div class="row container mx-auto pt-5">
          <div class="footer1 col-lg-3 col-md-6 col-sm-12">
            <img src="assets/imgs/">
            <p class="pt-3">We Provide the best products for the most affordable prices</p>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="">Featured</h5>
            <ul class="text-uppercase">
              <li><a href="#">men</a></li>
              <li><a href="#">women</a></li>
              <li><a href="#">boys</a></li>
              <li><a href="#">girls</a></li>
              <li><a href="#">new arrivals</a></li>
              <li><a href="#">clothes</a></li>
            </ul>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
           <h5 class="pb-2 ">Contact Us</h5>
           <div>
            <h6 class="text-uppercase">Address</h6>
            <p>1234 street name, city</p>

           </div>
           <div>
            <h6 class="text-uppercase">Phone</h6>
            <p>+639756657044</p>
            
           </div>
           <div>
            <h6 class="text-uppercase">Email</h6>
            <p>info@gmail.com</p>

            
           </div>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
            <h5 class="pd-2">Facebook</h5>
            <div class="row">
              <img src="assets/imgs/" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/" class="img-fluid w-25 h-100 m-2">
              <img src="assets/imgs/" class="img-fluid w-25 h-100 m-2">
            </div>
          </div>
        </div>


        <div class="copyright mt-5">
          <div class="row container mx-auto text-nowrap mb-2">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                <img src="https://logodix.com/logo/335568.png">
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
              <p>eCommerce @ 2025 All Rights Reserve</p>
          </div>
          <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></i></a>
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
        </div>
          </div>
        </div>

      </footer>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<script defer>
        document.addEventListener("DOMContentLoaded", () => {
            const cartCount = document.getElementById("cart-count");

            // Set the cart count using PHP data
            const cartTotal = <?php echo $cart_count; ?>;
            cartCount.textContent = cartTotal;
        });
    </script>