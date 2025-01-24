<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/imgs/icon-logo.png" type="image">
    <link rel="stylesheet" href="assets/css/chat.css">
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
            <a class="nav-link" href="product.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.html">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item">
            <i class="fas fa-shopping-bag"></i>
            <i class="fas fa-user"></i>
          </li>   
        </ul>
      </div>
    </div>
  </nav>



  <!--CheckOut-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5" >
        <h2 class="form-weight-bold">Check Out</h2>
        <hr class="mx-auto">
    </div>
    <div class="mx-auto container">
        <form action="" id="checkout-form">
            <div class="form-group checkout-small-element">
                <label>Name</label>
                <input type="text" class="form-control" id="checkout-name" name="checkout-name" placeholder="Name" required>

            </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
                
            </div>
            <div class="form-group checkout-small-element">
              <label >Phone</label>
               <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
            </div>
            <div class="form-group checkout-small-element">
              <label>City</label>
              <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
            </div>
            <div class="form-group checkout-large-element">
              <label>Address</label>
              <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
            </div>
            <div class="form-group checkout-btn-container">
              <input type="submit" class="btn" id="checkout-btn" value="Checkout">
            </div>
        </form>
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
