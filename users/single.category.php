<?php
session_start();
include_once "../php/config.php";

if(isset($_GET['product_category'])){

    $product_category = $_GET['product_category'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ?");
    $stmt->bind_param("s", $product_category);

    $stmt->execute();
    
    $featured_products = $stmt->get_result();


} else {
    header("Location: index.php");
}

if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
  

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
    header("Location: ../login.php"); 
    exit();
  }
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE  unique_id= '{$_SESSION['unique_id']}'");
  if (mysqli_num_rows($sql) > 0) {
      $row = mysqli_fetch_assoc($sql);
    
  }
?>







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Name</title>
  <link rel="shortcut icon" href="../admin/assets/images/logo/icon-logo.png" type="image/x-icon" />


  <link rel="stylesheet" href="./assets/css/style-prefix.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/home.css">



</head>

<body>
















  <!--
    - HEADER
  -->

  <header>

    <div class="header-top">

      <div class="container">

        <ul class="header-social-container">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

     

        


        </ul>

        <div class="header-alert-news">
          <p>
            <b>WE SERVE HEE</b>
          </p>
        </div>

     
      </div>

    </div>

    <div class="header-main">

      <div class="container">

        <a href="index.php" class="header-logo">
          <!-- <img src="./assets/images/logo/logo.svg" alt="Anon's logo" width="120" height="36"> -->
           <p style="font-weight: bolder; font-size: 30px; color:black;">CustomCraft</p>
        </a>

        <!-- <div class="header-search-container">

          <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

          <button class="search-btn">
            <ion-icon name="search-outline"></ion-icon>
          </button>

        </div> -->

        <div class="header-user-actions">

          <button class="action-btn ">
            <!-- <ion-icon name="person-outline"></ion-icon> -->
            <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image" onclick="toggleMenu()" id="profile">
           <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                <div class="user-info">
                <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image">
                <h2 class="user-name"><?php echo $row['fname'] ?></h2>
                </div>
                <hr>

                <a href="profile.php" class="sub-menu-link">
                  <img src="./assets/images/profile/profile.png">
                  <p class="letter-p-1">Edit Profile</p>
                  <span>></span>
                </a>
                <a href="settings.php" class="sub-menu-link">
                  <img src="./assets/images/profile/setting.png">
                  <p class="letter-p-2">Settings</p>
                  <span>></span>
                </a>
                <!-- <a href="#" class="sub-menu-link">
                  <img src="./assets/images/profile/help.png">
                  <p class="letter-p">Help and Support</p> 
                  <span>></span>
                </a> -->
                <a href="../php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="sub-menu-link">
                  <img src="./assets/images/profile/logout.png">
                  <p class="letter-p-3">Logout</p>
                  <span>></span>
                </a>
              </div>
           </div>
          </button>

          <!-- <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count">0</span>
          </button> -->
          <?php 
       $user_id = $_SESSION['unique_id']; // Assuming user is logged in

       // Query to check if the cart has items
       $sql = "SELECT COUNT(*) as count FROM cart WHERE unique_id = ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("s", $user_id); // Change "i" to "s" if unique_id is a string
       $stmt->execute();
       $result = $stmt->get_result();
       $row = $result->fetch_assoc();
       ?>
          <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count"><?php echo $row['count']; ?></span>
          </button>         

        </div>

      </div>

    </div>



    <div class="mobile-bottom-navigation">

      <!-- <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button> -->
<a href="cart.php">
    
<button class="action-btn">
        <ion-icon name="bag-handle-outline"></ion-icon>

        <span class="count">0</span>
      </button>
</a>

<a href="index.php">
<button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>
</a>

      <!-- <button class="action-btn">
        <ion-icon name="heart-outline"></ion-icon>

        <span class="count">0</span>
      </button> -->

      <!-- <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button> -->

    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
       
     
           </div>
            <h2 class="menu-title"><?php echo $row['fname'] ?></h2>
        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">

        <li class="menu-category">
          <a href="index.php" class="menu-title">Home</a>
        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Men's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shirt</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Shorts & Jeans</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Safety Shoes</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Wallet</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Women's</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Dress & Frock</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Makeup Kit</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Jewelry</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Earrings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Couple Rings</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Necklace</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Bracelets</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Perfume</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

          <ul class="submenu-category-list" data-accordion>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Clothes Perfume</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Deodorant</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Flower Fragrance</a>
            </li>

            <li class="submenu-category">
              <a href="#" class="submenu-title">Air Freshener</a>
            </li>

          </ul>

        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Blog</a>
        </li>

        <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li>

      </ul>

      <div class="menu-bottom">

        <ul class="menu-category-list">

          <li class="menu-category">

            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Language</p>

              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>

              <li class="submenu-category">
                <a href="#" class="submenu-title">English</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Espa&ntilde;ol</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">Fren&ccedil;h</a>
              </li>

            </ul>

          </li>

          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn>
              <p class="menu-title">Currency</p>
              <ion-icon name="caret-back-outline" class="caret-back"></ion-icon>
            </button>

            <ul class="submenu-category-list" data-accordion>
              <li class="submenu-category">
                <a href="#" class="submenu-title">USD &dollar;</a>
              </li>

              <li class="submenu-category">
                <a href="#" class="submenu-title">EUR &euro;</a>
              </li>
            </ul>
          </li>

        </ul>

        <ul class="menu-social-container">

          <li>
            <a href="" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </nav>

  </header>


  <div class="product-main">

<h2 class="title">Products</h2>

<div class="product-grid">
  <?php while($row = $featured_products->fetch_assoc()){ ?>

<a href="single.product.php?product_id=<?php echo $row['product_id']; ?>">
<div class="showcase">
<div class="showcase-banner">


<img src="../admin/<?php echo $row['product_image']; ?>" alt="Product Image" width="300" class="product-img default">
<img src="../admin/<?php echo $row['product_image2']; ?>" alt="Product Image Hover" width="300" class="product-img hover">

<div class="showcase-actions">
<button type="button" class="btn-action">
<ion-icon name="heart-outline"></ion-icon>
</button>

<button type="submit" class="btn-action" name="addtocart">
<ion-icon name="bag-add-outline"></ion-icon>
</button>
</div>
</div>

<div class="showcase-content">
<p class="showcase-category"><?php echo $row['product_name']; ?></p>
<h3 class="showcase-title"><?php echo $row['product_description']; ?></h3>

<div class="showcase-rating">
<ion-icon name="star"></ion-icon>
<ion-icon name="star"></ion-icon>
<ion-icon name="star"></ion-icon>
<ion-icon name="star-outline"></ion-icon>
<ion-icon name="star-outline"></ion-icon>
</div>

<div class="price-box">
<p class="price">₱<?php echo $row['product_price']; ?></p>
</div>
</div>
</div>
</a>

  <?php } ?>


</div>

</div>
         




              
                  

   


            <script>
    document.addEventListener("DOMContentLoaded", function () {
        const minusButton = document.querySelector(".minus");
        const plusButton = document.querySelector(".plus");
        const quantityInput = document.querySelector(".quantity");

        minusButton.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        plusButton.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    });
</script>


  

    


  <!--
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
   let subMenu = document.getElementById("subMenu");

function toggleMenu() {
    subMenu.classList.toggle("open-menu");
}

// Close the menu when clicking anywhere outside of it
document.addEventListener("click", function(event) {
    let profile = document.getElementById("profile"); // Assuming profile is the button/icon that toggles the menu
    if (!subMenu.contains(event.target) && !profile.contains(event.target)) {
        subMenu.classList.remove("open-menu");
    }
});

  </script>

<script>
let subMenus = document.getElementById("subMenus");
let profile = document.getElementById("profiles");

function toggleMenus() {
    subMenus.classList.toggle("open-menu");
}

// Close the menu when clicking anywhere outside of it
document.addEventListener("click", function(event) {
    if (!subMenus.contains(event.target) && !profile.contains(event.target)) {
        subMenus.classList.remove("open-menu");
    }
});

// Prevent event bubbling inside the menu
subMenus.addEventListener("click", function(event) {
    event.stopPropagation();
});

  </script>


</body>

</html>







