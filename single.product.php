<?php

include_once "php/config.php";
if(isset($_GET['product_name'])){
  


  $product_id = $_GET['product_name'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_name=? LIMIT 1");
  $stmt->bind_param("s",$product_id);
  
  $stmt->execute();
  
  
  $product = $stmt->get_result();
  
}else{
  header('location: home.php');
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
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Product</title>
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

    <!--Single product-->
  <section class="container single-product my-5 pt-5">
    <div class="row mt-5">
    <?php while($row = $product->fetch_assoc()){?>



        <div class="col-lg-5 col-sm-12">
            <img src="assets/imgs/<?php echo $row['product_image']; ?>" class="img-fluid w-100 pd-1" id="mainImg">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image2']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image3']; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="assets/imgs/<?php echo $row['product_image4']; ?>" width="100%" class="small-img">
                </div>
            </div>
           
        </div>
      
        <div class="col-lg-6 col-md-12 col-12">
          <h6>Men/Shoes</h6>
          <h3><?php echo $row['product_name']; ?></h3>
          <h2>₱<?php echo $row['product_price']; ?></h2>

          

          <form action="cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>">
        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">
          <input type="number" value="1" name="product_quantity">
          <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
          </form>
          <h4 class="mt-5 mb-5">Product details</h4>
          <span><?php echo $row['product_description']; ?>
          </span>
         
        </div>
      
     
        <?php }?>
    </div>
  </section>


      <!--Related products-->
      <section id="related-products" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
          <h3>Related Products</h3>
          <hr class="mx-auto">
        </div>
        <div class="row mx-auto container-fluid">
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
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
    <script>
      var mainImg = document.getElementById("mainImg");
      var smallImg = document.getElementsByClassName("small-img");

      for(let i=0; i<4; i++){
        smallImg[i].onclick = function(){
        mainImg.src = smallImg[i].src;
      }
     
      }

   

    </script>



<script>
  // JavaScript code for handling Add to Cart functionality
document.addEventListener("DOMContentLoaded", () => {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });

  const addToCartButtons = document.querySelectorAll(".buy-btn");

  addToCartButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault(); // Prevent default form submission

      // Get the product data from the hidden inputs
      const productElement = event.target.closest("form");
      const productId = productElement.querySelector("input[name='product_id']").value;
      const productImage = productElement.querySelector("input[name='product_image']").value;
      const productName = productElement.querySelector("input[name='product_name']").value;
      const productPrice = productElement.querySelector("input[name='product_price']").value;
      const productQuantity = productElement.querySelector("input[name='product_quantity']").value;

      // Create the product object
      const product = {
        product_id: productId,
        product_name: productName,
        product_price: parseFloat(productPrice),
        product_image: productImage,
        product_quantity: parseInt(productQuantity),
      };

      // Get the cart from localStorage
      let cart = JSON.parse(localStorage.getItem("cart")) || {};

      // Check if the product is already in the cart
      if (cart[productId]) {
        Toast.fire({
          icon: "warning",
          title: "Product is already in the cart."
        });
      } else {
        // Add the product to the cart
        cart[productId] = product;
        localStorage.setItem("cart", JSON.stringify(cart));
        Toast.fire({
          icon: "success",
          title: "Product added to the cart successfully."
        });
      }
    });
  });
});

</script>
</body>
</html>