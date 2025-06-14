<?php
session_start();
include_once "../php/config.php";

// session_start();

// if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
//   header("Location: ../login.php"); // Redirect unauthorized users
//   exit();
// }

if(!isset($_SESSION['unique_id'])){
  header("location: ../login.php");
}






?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CustomCraft</title>
  <link rel="shortcut icon" href="../admin/assets/images/logo/icon-logo.png" type="image/x-icon" />

  <!--
    - favicon
  -->
  <!-- <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon"> -->

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style-prefix.css">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>


  <div class="overlay" data-overlay></div>

  <!--
    - MODAL
  -->

  <div class="modal" data-modal style="display: none;">

    <div class="modal-close-overlay" data-modal-overlay style="display: none;"></div>

    <div class="modal-content">

      <button class="modal-close-btn" data-modal-close>
        <ion-icon name="close-outline"></ion-icon>
      </button>

      <div class="newsletter-img">
        <img src="./assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
      </div>

      <div class="newsletter" style="display: none;">

        <form >

          <div class="newsletter-header">

            <h3 class="newsletter-title">This is a adds</h3>

            <p class="newsletter-desc">
              This is an adds of <b>CustomCraft</b> to.
            </p>

          </div>

          <!-- <input type="email" name="email" class="email-field" placeholder="Email Address" required> -->

          <a href="shop.php"><button class="btn-newsletter">Shop Now</button></a>

        </form>

      </div>

    </div>

  </div>





  <!--
    - NOTIFICATION TOAST
  -->

  <!-- <div class="notification-toast" data-toast> -->

    <button class="toast-close-btn" data-toast-close  style="display: none;">
      <ion-icon name="close-outline"></ion-icon >
    </button>

    <!-- <div class="toast-banner">
      <img src="./assets/images/products/jewellery-1.jpg" alt="Rose Gold Earrings" width="80" height="70">
    </div> -->

    <!-- <div class="toast-detail">

      <p class="toast-message">
        Someone in new just bought
      </p>

      <p class="toast-title">
        Rose Gold Earrings
      </p>

      <p class="toast-meta">
        <time datetime="PT2M">2 Minutes</time> ago
      </p>

    </div> -->

  <!-- </div> -->





  <!--
    - HEADER
  -->

  <header>

    <div class="header-top">

      <div class="container">

        <ul class="header-social-container">

          <li>
            <a href="https://www.facebook.com/justine.francisco.1481" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <!-- <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li> -->

          <!-- <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li> -->
<!-- 
          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li> -->

        </ul>

        <div class="header-alert-news">
          <p>
            <b>WE SERVE HERE</b>
          </p>
        </div>

        <!-- <div class="header-top-actions">

          <select name="currency">

            <option value="usd">USD &dollar;</option>
            <option value="eur">EUR &euro;</option>

          </select>

          <select name="language">

            <option value="en-US">English</option>
            <option value="es-ES">Espa&ntilde;ol</option>
            <option value="fr">Fran&ccedil;ais</option>

          </select>

        </div> -->

      </div>

    </div>

    <div class="header-main">

      <div class="container">

        <a href="index.php" class="header-logo">
          <!-- <img src="./assets/images/logo/logo.svg" alt="Anon's logo" width="120" height="36"> -->
           <p style="font-weight: bolder; font-size: 30px; color:black;">CustomCraft</p>
        </a>

        <div class="header-search-container">

         <form action="search.php" method="GET">
         <input type="search" name="search" class="search-field" placeholder="Enter your product name...">

<button class="search-btn" type="submit">
  <ion-icon name="search-outline"></ion-icon>
</button>
         </form>

        </div>
        <?php
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    // You can now use $row for admin-specific information
}
        ?>
        <div class="header-user-actions">

          <button class="action-btn ">
            <!-- <ion-icon name="person-outline"></ion-icon> -->
                      <?php
// After fetching $row from the database:
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" onclick="toggleMenu()" id="profile">
           <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                <div class="user-info">
                                <?php
// After fetching $row from the database:
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" onclick="toggleMenu()" id="profile">
                <h2 class="user-name"><?php echo $row['fname'] ?></h2>
                </div>
                <hr>

                <a href="profile.php" class="sub-menu-link">
                  <img src="./assets/images/profile/profile.png">
                  <p class="letter-p-1">See Profile</p>
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

       <a href="../users.php">   <button class="action-btn">
        <i class="fas fa-comments" style="font-size:40px; color:#02766f;"></i>
            <!-- <span class="count">0</span> -->
          </button></a>
          
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
        <a href="cart.php">
        <button class="action-btn">
            <ion-icon name="cart-outline"></ion-icon>
            <span class="count"><?php echo $row['count']; ?></span>
          </button>
        </a>         

        </div>

      </div>

    </div>

    <nav class="desktop-navigation-menu">

      <div class="container">

        <ul class="desktop-menu-category-list">

          <li class="menu-category">
            <a href="index.php" class="menu-title">Home</a>
          </li>
          <li class="menu-category">
            <a href="shop.php" class="menu-title">Shop</a>
          </li>

         

          <!-- <li class="menu-category">
            <a href="#" class="menu-title">Men's</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Shirt</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Shorts & Jeans</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Safety Shoes</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Wallet</a>
              </li>

            </ul>
          </li> -->

          <!-- <li class="menu-category">
            <a href="#" class="menu-title">Women's</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Dress & Frock</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Makeup Kit</a>
              </li>

            </ul>
          </li> -->

          <!-- <li class="menu-category">
            <a href="#" class="menu-title">Jewelry</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Earrings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Couple Rings</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Necklace</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Bracelets</a>
              </li>

            </ul>
          </li> -->

          <!-- <li class="menu-category">
            <a href="#" class="menu-title">Perfume</a>

            <ul class="dropdown-list">

              <li class="dropdown-item">
                <a href="#">Clothes Perfume</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Deodorant</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Flower Fragrance</a>
              </li>

              <li class="dropdown-item">
                <a href="#">Air Freshener</a>
              </li>

            </ul>
          </li> -->

          <!-- <li class="menu-category">
            <a href="#" class="menu-title">Blog</a>
          </li> -->
          

          <li class="menu-category">
            <a href="../create/index.php" class="menu-title">CREATE YOURS</a>
          </li>
          <li class="menu-category">
            <a href="orders.php" class="menu-title">MY ORDER</a>
          </li>

        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
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

      <a href="cart.php">
      <button class="action-btn">
         <ion-icon name="cart-outline"></ion-icon>

        <span class="count"><?php echo $row['count'] ?></span>
      </button>
      </a>

   <a href="index.php">
   <button class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </button>
   </a>

    <a href="../users.php">
    <button class="action-btn">
       <i class="fas fa-comments" style="font-size:40px; color:#02766f;"></i>

        <!-- <span class="count">0</span> -->
      </button>
    </a>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>

    </div>

    <?php
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        // You can now use $row for admin-specific information
    }
    ?>
    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>

      <div class="menu-top">
       
                 <?php
// After fetching $row from the database:
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" onclick="toggleMenu()" id="profile">
           <div class="sub-menu-wrap" id="subMenus">
              <div class="sub-menu">
                <div class="user-info">
                                <?php
// After fetching $row from the database:
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" onclick="toggleMenu()" id="profile">
                <h2 class="user-name"><?php echo $row['fname'] ?></h2>
                </div>
                <hr>

                <a href="profile.php" class="sub-menu-link">
                  <img src="./assets/images/profile/profile.png">
                  <p class="letter-p-1">See Profile</p>
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
          <a href="shop.php" class="menu-title">Shop</a>
        </li>
        
        <li class="menu-category">
          <a href="../create/index.php" class="menu-title">Create Yours</a>
        </li>
        <li class="menu-category">
          <a href="orders.php" class="menu-title">My Order</a>
        </li>

    <!-- diara -->
     
        <li class="menu-category">

        

          <?php $stmt = $conn->prepare("SELECT product_category, COUNT(*) AS product_count FROM products GROUP BY product_category ORDER BY product_category ASC");
                $stmt->execute();
                $result = $stmt->get_result();
              ?>


          <ul class="submenu-category-list" data-accordion>

          <?php while($row =$result->fetch_assoc()){ ?>

<li class="sidebar-submenu-category">
  <a href="single.category.php?product_category=<?php echo $row['product_category']; ?>" class="sidebar-submenu-title">
    <p class="product-name"><?php echo $row['product_category']; ?></p>
    <data value="300" class="stock" title="Available Stock"><?php echo $row['product_count']; ?></data>
  </a>
</li>
<?php } ?>

            <!-- <li class="submenu-category">
              <a href="#" class="submenu-title">Shorts & Jeans</a>
            </li> -->

            <!-- <li class="submenu-category">
              <a href="#" class="submenu-title">Safety Shoes</a>
            </li> -->

            <!-- <li class="submenu-category">
              <a href="#" class="submenu-title">Wallet</a>
            </li> -->

          </ul>



        <!-- <li class="menu-category">

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

        </li> -->

        <!-- <li class="menu-category">

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

        </li> -->

        <!-- <li class="menu-category">
          <a href="#" class="menu-title">Hot Offers</a>
        </li> -->

      </ul>

      <div class="menu-bottom">

        <!-- <ul class="menu-category-list">

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

        </ul> -->

        <ul class="menu-social-container">

          <li>
            <a href="https://www.facebook.com/justine.francisco.1481" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <!-- <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li> -->

          <!-- <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li> -->

          <!-- <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li> -->

        </ul>

      </div>

    </nav>

  </header>





  <!--
    - MAIN
  -->

  <main>

    <!--
      - BANNER
    -->

    <div class="banner">

      <div class="container">

        <div class="slider-container has-scrollbar">

          <!-- <div class="slider-item">

            <img src="./assets/images/banner-1.jpg" alt="women's latest fashion sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Shop Smart</p>

              <h2 class="banner-title">Your one-stop shop for everything you love.</h2> -->

              <!-- <p class="banner-text">
                starting at &dollar; <b>20</b>.00
              </p> -->

              <!-- <a href="shop.php" class="banner-btn">Shop now</a>

            </div>

          </div> -->

          <!-- <div class="slider-item">

            <img src="./assets/images/banner-2.jpg" alt="modern sunglasses" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Style Simplified</p>

              <h2 class="banner-title">Bringing the best deals right to your doorstep.</h2> -->

              <!-- <p class="banner-text">
                starting at &dollar; <b>15</b>.00
              </p> -->

              <!-- <a href="shop.php" class="banner-btn">Shop now</a>

            </div>

          </div> -->

          <!-- <div class="slider-item">

            <img src="./assets/images/banner-3.jpg" alt="new fashion summer sale" class="banner-img">

            <div class="banner-content">

              <p class="banner-subtitle">Shop Easy</p>

              <h2 class="banner-title">Shop smart, live stylish.</h2> -->

              <!-- <p class="banner-text">
                starting at &dollar; <b>29</b>.99
              </p> -->

              <!-- <a href="shop.php" class="banner-btn">Shop now</a>

            </div>

          </div> -->

        </div>

      </div>

    </div>





    <!--
      - CATEGORY
    -->

    <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/tee.svg" alt="dress & frock" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Shirts</h3>

                <p class="category-item-amount">(53)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/coat.svg" alt="winter wear" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Winter wear</h3>

                <p class="category-item-amount">(58)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->
<!-- 
          <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/glasses.svg" alt="glasses & lens" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Glasses & lens</h3>

                <p class="category-item-amount">(68)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/shorts.svg" alt="shorts & jeans" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Shorts & jeans</h3>

                <p class="category-item-amount">(84)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/tee.svg" alt="t-shirts" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">T-shirts</h3>

                <p class="category-item-amount">(35)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/jacket.svg" alt="jacket" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Jacket</h3>

                <p class="category-item-amount">(16)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/watch.svg" alt="watch" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Watch</h3>

                <p class="category-item-amount">(27)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

          <!-- <div class="category-item">

            <div class="category-img-box">
              <img src="./assets/images/icons/hat.svg" alt="hat & caps" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Hat & caps</h3>

                <p class="category-item-amount">(39)</p>
              </div>

              <a href="#" class="category-btn">Show all</a>

            </div>

          </div> -->

        </div>

      </div>

    </div>





    <!--
      - PRODUCT
    -->

    <div class="product-container">

      <div class="container">


        <!--
          - SIDEBAR
        -->

        <div class="sidebar  has-scrollbar" data-mobile-menu>

         

              </li>

              <!-- <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/shoes.svg" alt="footwear" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Footwear</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Sports</p>
                      <data value="45" class="stock" title="Available Stock">45</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Formal</p>
                      <data value="75" class="stock" title="Available Stock">75</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Casual</p>
                      <data value="35" class="stock" title="Available Stock">35</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Safety Shoes</p>
                      <data value="26" class="stock" title="Available Stock">26</data>
                    </a>
                  </li>

                </ul>

              </li> -->

              <!-- <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/jewelry.svg" alt="clothes" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Jewelry</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Earrings</p>
                      <data value="46" class="stock" title="Available Stock">46</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Couple Rings</p>
                      <data value="73" class="stock" title="Available Stock">73</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Necklace</p>
                      <data value="61" class="stock" title="Available Stock">61</data>
                    </a>
                  </li>

                </ul>

              </li> -->

              <!-- <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/perfume.svg" alt="perfume" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Perfume</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Clothes Perfume</p>
                      <data value="12" class="stock" title="Available Stock">12 pcs</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Deodorant</p>
                      <data value="60" class="stock" title="Available Stock">60 pcs</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">jacket</p>
                      <data value="50" class="stock" title="Available Stock">50 pcs</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">dress & frock</p>
                      <data value="87" class="stock" title="Available Stock">87 pcs</data>
                    </a>
                  </li>

                </ul>

              </li> -->

              <!-- <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/cosmetics.svg" alt="cosmetics" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Cosmetics</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Shampoo</p>
                      <data value="68" class="stock" title="Available Stock">68</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Sunscreen</p>
                      <data value="46" class="stock" title="Available Stock">46</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Body Wash</p>
                      <data value="79" class="stock" title="Available Stock">79</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Makeup Kit</p>
                      <data value="23" class="stock" title="Available Stock">23</data>
                    </a>
                  </li>

                </ul>

              </li> -->

              <!-- <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/glasses.svg" alt="glasses" class="menu-title-img" width="20"
                      height="20">

                    <p class="menu-title">Glasses</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Sunglasses</p>
                      <data value="50" class="stock" title="Available Stock">50</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Lenses</p>
                      <data value="48" class="stock" title="Available Stock">48</data>
                    </a>
                  </li>

                </ul>

              </li> -->

              <!-- <li class="sidebar-menu-category">

                <button class="sidebar-accordion-menu" data-accordion-btn>

                  <div class="menu-title-flex">
                    <img src="./assets/images/icons/bag.svg" alt="bags" class="menu-title-img" width="20" height="20">

                    <p class="menu-title">Bags</p>
                  </div>

                  <div>
                    <ion-icon name="add-outline" class="add-icon"></ion-icon>
                    <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                  </div>

                </button>

                <ul class="sidebar-submenu-category-list" data-accordion>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Shopping Bag</p>
                      <data value="62" class="stock" title="Available Stock">62</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Gym Backpack</p>
                      <data value="35" class="stock" title="Available Stock">35</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Purse</p>
                      <data value="80" class="stock" title="Available Stock">80</data>
                    </a>
                  </li>

                  <li class="sidebar-submenu-category">
                    <a href="#" class="sidebar-submenu-title">
                      <p class="product-name">Wallet</p>
                      <data value="75" class="stock" title="Available Stock">75</data>
                    </a>
                  </li> -->

                </ul>

              </li>

            </ul>

          </div>

          <!-- <div class="product-showcase">

            <h3 class="showcase-heading">best sellers</h3>

            <div class="showcase-wrapper">

              <div class="showcase-container">

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/products/1.jpg" alt="baby fabric shoes" width="75" height="75"
                      class="showcase-img">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">baby fabric shoes</h4>
                    </a>

                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>$5.00</del>
                      <p class="price">$4.00</p>
                    </div>

                  </div>

                </div>

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/products/2.jpg" alt="men's hoodies t-shirt" class="showcase-img"
                      width="75" height="75">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">men's hoodies t-shirt</h4>
                    </a>
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-half-outline"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>$17.00</del>
                      <p class="price">$7.00</p>
                    </div>

                  </div>

                </div>

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/products/3.jpg" alt="girls t-shirt" class="showcase-img" width="75"
                      height="75">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">girls t-shirt</h4>
                    </a>
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-half-outline"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>$5.00</del>
                      <p class="price">$3.00</p>
                    </div>

                  </div>

                </div>

                <div class="showcase">

                  <a href="#" class="showcase-img-box">
                    <img src="./assets/images/products/4.jpg" alt="woolen hat for men" class="showcase-img" width="75"
                      height="75">
                  </a>

                  <div class="showcase-content">

                    <a href="#">
                      <h4 class="showcase-title">woolen hat for men</h4>
                    </a>
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div>

                    <div class="price-box">
                      <del>$15.00</del>
                      <p class="price">$12.00</p>
                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div> -->

        </div>



        <div class="product-box">

          <!--
            - PRODUCT MINIMAL
          -->

<style>
.showcase-container {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-bottom: 30px;
}
.showcase {
  border: 1px solid #eee;
  background: #fff;
  border-radius: 8px;
  padding: 10px;
  display: flex;
  align-items: flex-start;
  gap: 20px;
}
.showcase-img {
  border-radius: 6px;
}
.order-header {
  margin: 30px 0 10px 0;
  font-weight: bold;
  font-size: 18px;
  color: #02766f;
}
.cancel-btn {
  background: #e74c3c;
  color: #fff;
  border: none;
  padding: 6px 18px;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 10px;
  font-weight: bold;
}
.cancel-btn[disabled] {
  background: #ccc;
  cursor: not-allowed;
}
</style>

<div class="product-minimal">
  <div class="product-showcase">
    <h2 class="title" style="text-align: center;">My Orders</h2>
    <div class="showcase-wrapper has-scrollbar">
      <div class="showcase-container">
        <?php
        $user_id = $_SESSION['unique_id'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE unique_id = ? ORDER BY order_date DESC, order_id DESC");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $orders = $stmt->get_result();

        $last_order_date = null;
        $last_order_status = null;
        while ($order = $orders->fetch_assoc()) {
            // If this is a new order date, print the header and the cancel button
            if ($last_order_date !== $order['order_date']) {
                // Show Cancel button only if not already cancelled or delivered
                $show_cancel = ($order['status'] !== 'Cancelled' && $order['status'] !== 'Delivered');
                echo '<div class="order-header">Order Date: ' . date('Y-m-d H:i:s', strtotime($order['order_date']));
                if ($show_cancel) {
                    // Use a form to POST the order_date for cancellation
                    echo '
                    <form method="post" action="" style="display:inline;">
                        <input type="hidden" name="cancel_order_date" value="' . htmlspecialchars($order['order_date']) . '">
                        <button type="submit" class="cancel-btn" onclick="return confirm(\'Are you sure you want to cancel this order?\')">Cancel Order</button>
                    </form>';
                } else {
                    echo ' <span style="color:#e74c3c;font-size:14px;">[' . htmlspecialchars($order['status']) . ']</span>';
                }
                echo '</div>';
                $last_order_date = $order['order_date'];
                $last_order_status = $order['status'];
            }
            $product_id = $order['product_id'];
            $stmt_product = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt_product->bind_param("i", $product_id);
            $stmt_product->execute();
            $product_result = $stmt_product->get_result();

            if ($product = $product_result->fetch_assoc()) {
        ?>
        <div class="showcase">
          <img src="../admin/<?php echo $product['product_image']; ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="showcase-img" width="70">
          <div class="showcase-content">
            <h4 class="showcase-title"><?php echo htmlspecialchars($product['product_name']); ?></h4>
            <p class="showcase-category">Quantity: (<?php echo htmlspecialchars($order['quantity']); ?>)</p>
            <p class="showcase-category">Unit Price ₱<?php echo htmlspecialchars($order['price']); ?></p>
            <p class="showcase-category">Payment Method: <?php echo htmlspecialchars($order['method']); ?></p>
            <div class="price-box">
              <p class="price">Total Price ₱<?php echo htmlspecialchars($order['subtotal'] + $order['shipping_fee']); ?></p>
            </div>
          </div>
        </div>
        <?php
            }
            $stmt_product->close();
        }

        // Handle cancellation POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order_date'])) {
            $cancel_date = $_POST['cancel_order_date'];
            $cancel_stmt = $conn->prepare("UPDATE orders SET status='Cancelled' WHERE unique_id=? AND order_date=? AND status NOT IN ('Cancelled','Delivered')");
            $cancel_stmt->bind_param("ss", $user_id, $cancel_date);
            $cancel_stmt->execute();
            echo "<script>window.location.href=window.location.href;</script>"; // Refresh to show updated status
        }
        ?>
      </div>
    </div>
  </div>
</div>









          





    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

      <div class="container">

        <div class="testimonials-box">

          <!--
            - TESTIMONIALS
          -->

          <div class="testimonial">
<!-- 
            <h2 class="title">testimonial</h2>

            <div class="testimonial-card">

              <img src="./assets/images/testimonial-1.jpg" alt="alan doe" class="testimonial-banner" width="80" height="80">

              <p class="testimonial-name">Alan Doe</p>

              <p class="testimonial-title">CEO & Founder Invision</p>

              <img src="./assets/images/icons/quotes.svg" alt="quotation" class="quotation-img" width="26">

              <p class="testimonial-desc">
                Lorem ipsum dolor sit amet consectetur Lorem ipsum
                dolor dolor sit amet.
              </p>

            </div>

          </div> -->



          <!--
            - CTA
          -->

          <!-- <div class="cta-container">

            <img src="./assets/images/cta-banner.jpg" alt="summer collection" class="cta-banner">

            <a href="#" class="cta-content">

              <p class="discount">25% Discount</p>

              <h2 class="cta-title">Summer collection</h2>

              <p class="cta-text">Starting @ $10</p>

              <button class="cta-btn">Shop now</button>

            </a>

          </div> -->



          <!--
            - SERVICE
          -->

          <!-- <div class="service">

            <h2 class="title">Our Services</h2>

            <div class="service-container">

              <a href="#" class="service-item">

                <div class="service-icon">
                  <ion-icon name="boat-outline"></ion-icon>
                </div>

                <div class="service-content">

                  <h3 class="service-title">Worldwide Delivery</h3>
                  <p class="service-desc">For Order Over $100</p>

                </div>

              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="rocket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Next Day delivery</h3>
                  <p class="service-desc">UK Orders Only</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Best Online Support</h3>
                  <p class="service-desc">Hours: 8AM - 11PM</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="arrow-undo-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Return Policy</h3>
                  <p class="service-desc">Easy & Free Return</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="ticket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">30% money back</h3>
                  <p class="service-desc">For Order Over $100</p>
              
                </div>
              
              </a>

            </div>

          </div> -->

        </div>

      </div>

    </div>





    <!--
      - BLOG
    -->

    <!-- <div class="blog">

      <div class="container">

        <div class="blog-container has-scrollbar">

          <div class="blog-card">

            <a href="#">
              <img src="./assets/images/blog-1.jpg" alt="Clothes Retail KPIs 2021 Guide for Clothes Executives" width="300" class="blog-banner">
            </a>

            <div class="blog-content">

              <a href="#" class="blog-category">Fashion</a>

              <a href="#">
                <h3 class="blog-title">Clothes Retail KPIs 2021 Guide for Clothes Executives.</h3>
              </a>

              <p class="blog-meta">
                By <cite>Mr Admin</cite> / <time datetime="2022-04-06">Jan 06, 2025</time>
              </p>

            </div>

          </div>

          <div class="blog-card">
          
            <a href="#">
              <img src="./assets/images/blog-2.jpg" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="#" class="blog-category">Clothes</a>
          
              <h3>
                <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup Battle.</a>
              </h3>
          
              <p class="blog-meta">
                By <cite>Mr Robin</cite> / <time datetime="2022-01-18">Jan 18, 2025</time>
              </p>
          
            </div>
          
          </div>

          <div class="blog-card">
          
            <a href="#">
              <img src="./assets/images/blog-3.jpg" alt="EBT vendors: Claim Your Share of SNAP Online Revenue."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="#" class="blog-category">Shoes</a>
          
              <h3>
                <a href="#" class="blog-title">EBT vendors: Claim Your Share of SNAP Online Revenue.</a>
              </h3>
          
              <p class="blog-meta">
                By <cite>Mr Selsa</cite> / <time datetime="2022-02-10">Feb 10, 2025</time>
              </p>
          
            </div>
          
          </div>

          <div class="blog-card">
          
            <a href="#">
              <img src="./assets/images/blog-4.jpg" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="#" class="blog-category">Electronics</a>
          
              <h3>
                <a href="#" class="blog-title">Curbside fashion Trends: How to Win the Pickup Battle.</a>
              </h3>
          
              <p class="blog-meta">
                By <cite>Mr Pawar</cite> / <time datetime="2022-03-15">Mar 15, 2022</time>
              </p>
          
            </div>
          
          </div>

        </div>

      </div>

    </div> -->

  </main>





  <!--
    - FOOTER
  -->

  <footer>

    <!-- <div class="footer-category">

      <div class="container"> -->

        <!-- <h2 class="footer-category-title">Brand directory</h2> -->

        <!-- <div class="footer-category-box">

          <h3 class="category-box-title">Fashion :</h3>

          <a href="#" class="footer-category-link">T-shirt</a>
          <a href="#" class="footer-category-link">Shirts</a>
          <a href="#" class="footer-category-link">shorts & jeans</a>
          <a href="#" class="footer-category-link">jacket</a>
          <a href="#" class="footer-category-link">dress & frock</a>
          <a href="#" class="footer-category-link">innerwear</a>
          <a href="#" class="footer-category-link">hosiery</a>

        </div> -->

        <!-- <div class="footer-category-box">
          <h3 class="category-box-title">footwear :</h3>
        
          <a href="#" class="footer-category-link">sport</a>
          <a href="#" class="footer-category-link">formal</a>
          <a href="#" class="footer-category-link">Boots</a>
          <a href="#" class="footer-category-link">casual</a>
          <a href="#" class="footer-category-link">cowboy shoes</a>
          <a href="#" class="footer-category-link">safety shoes</a>
          <a href="#" class="footer-category-link">Party wear shoes</a>
          <a href="#" class="footer-category-link">Branded</a>
          <a href="#" class="footer-category-link">Firstcopy</a>
          <a href="#" class="footer-category-link">Long shoes</a>
        </div> -->

        <!-- <div class="footer-category-box">
          <h3 class="category-box-title">jewellery :</h3>
        
          <a href="#" class="footer-category-link">Necklace</a>
          <a href="#" class="footer-category-link">Earrings</a>
          <a href="#" class="footer-category-link">Couple rings</a>
          <a href="#" class="footer-category-link">Pendants</a>
          <a href="#" class="footer-category-link">Crystal</a>
          <a href="#" class="footer-category-link">Bangles</a>
          <a href="#" class="footer-category-link">bracelets</a>
          <a href="#" class="footer-category-link">nosepin</a>
          <a href="#" class="footer-category-link">chain</a>
          <a href="#" class="footer-category-link">Earrings</a>
          <a href="#" class="footer-category-link">Couple rings</a>
        </div> -->

        <!-- <div class="footer-category-box">
          <h3 class="category-box-title">cosmetics :</h3>
        
          <a href="#" class="footer-category-link">Shampoo</a>
          <a href="#" class="footer-category-link">Bodywash</a>
          <a href="#" class="footer-category-link">Facewash</a>
          <a href="#" class="footer-category-link">makeup kit</a>
          <a href="#" class="footer-category-link">liner</a>
          <a href="#" class="footer-category-link">lipstick</a>
          <a href="#" class="footer-category-link">prefume</a>
          <a href="#" class="footer-category-link">Body soap</a>
          <a href="#" class="footer-category-link">scrub</a>
          <a href="#" class="footer-category-link">hair gel</a>
          <a href="#" class="footer-category-link">hair colors</a>
          <a href="#" class="footer-category-link">hair dye</a>
          <a href="#" class="footer-category-link">sunscreen</a>
          <a href="#" class="footer-category-link">skin loson</a>
          <a href="#" class="footer-category-link">liner</a>
          <a href="#" class="footer-category-link">lipstick</a>
        </div> -->

      <!-- </div>

    </div> -->

    <!-- <div class="footer-nav">

      <div class="container">

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Popular Categories</h2>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Fashion</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Electronic</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Cosmetic</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Health</a>
          </li>

          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Watches</a>
          </li>

        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Products</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Prices drop</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">New products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Best sales</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Contact us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Sitemap</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Our Company</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Delivery</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Legal Notice</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Terms and conditions</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">About us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Secure payment</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">
        
          <li class="footer-nav-item">
            <h2 class="nav-title">Services</h2>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Prices drop</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">New products</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Best sales</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Contact us</a>
          </li>
        
          <li class="footer-nav-item">
            <a href="#" class="footer-nav-link">Sitemap</a>
          </li>
        
        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Contact</h2>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="location-outline"></ion-icon>
            </div>

            <address class="content">
              419 State 414 Rte
              Beaver Dams, New York(NY), 14812, USA
            </address>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="call-outline"></ion-icon>
            </div>

            <a href="tel:+607936-8058" class="footer-nav-link">(607) 936-8058</a>
          </li>

          <li class="footer-nav-item flex">
            <div class="icon-box">
              <ion-icon name="mail-outline"></ion-icon>
            </div>

            <a href="mailto:example@gmail.com" class="footer-nav-link">example@gmail.com</a>
          </li>

        </ul>

        <ul class="footer-nav-list">

          <li class="footer-nav-item">
            <h2 class="nav-title">Follow Us</h2>
          </li>

          <li>
            <ul class="social-link">

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-facebook"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-twitter"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-linkedin"></ion-icon>
                </a>
              </li>

              <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">
                  <ion-icon name="logo-instagram"></ion-icon>
                </a>
              </li>

            </ul>
          </li>

        </ul>

      </div>

    </div> -->

    <div class="footer-bottom">

      <div class="container">

        <img src="./assets/images/payment.png" alt="payment method" class="payment-img">

        <p class="copyright">
          Copyright &copy; <a href="index.php">CustomCraft</a> all rights reserved.
        </p>

      </div>

    </div>

  </footer>






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






