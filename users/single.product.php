<?php
session_start();
include_once "../php/config.php";
if(isset($_GET['product_id'])){

    $product_name = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_name);

    $stmt->execute();
    
    $featured_products = $stmt->get_result();


}else{
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
        <?php
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
                  <p class="letter-p-1">Edit Profile</p>
                  <span>></span>
                </a>
                <a href="settings.php" class="sub-menu-link">
                  <img src="./assets/images/profile/setting.png">
                  <p class="letter-p-2">Settings</p>
                  <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
                  <img src="./assets/images/profile/help.png">
                  <p class="letter-p">Help and Support</p> 
                  <span>></span>
                </a>
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
          <a href="cart.php">
          <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count"><?php echo $row['count']; ?></span>
          </button>         
          </a>

        </div>

      </div>

    </div>



    <div class="mobile-bottom-navigation">

      <!-- <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button> -->

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
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count"><?php echo $row['count']; ?></span>
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

  <style>
        .counter {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
        }
        h1 {
            cursor: pointer;
            user-select: none;
            font-size: 20px;
            padding-right: 5px;
            padding-left: 5px;
            border: 1px solid #000;
            background-color: black;
            color: white;
        }
        input {
            width: 50px;
            text-align: center;
        }
        /* Hide arrows in Chrome, Safari, Edge, and Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>


          <!--
            - PRODUCT FEATURED
          -->
                <?php while($row = $featured_products->fetch_assoc()){ ?>

                    <form action="./phpController/addtocart.php" method="POST">
                        <input type="hidden" value="<?php echo $row['product_id'] ?>" name="product_id">
                        <input type="hidden" value="<?php echo $row['product_name']?>" name="product_name">
                        <input type="hidden" value="<?php echo $row['product_description']?>" name="product_description">
                        <input type="hidden" value="<?php echo $row['product_price']?>" name="product_price">
                        <input type="hidden" value="<?php echo $_SESSION['unique_id'] ?>" name="unique_id">
                         <input type="hidden" value="<?php echo $row['product_image']; ?>" name="product_image">
          <div class="product-featured">

            <!-- <h2 class="title">Deal of the day</h2> -->

            <div class="showcase-wrapper has-scrollbar">

              <div class="showcase-container">

                <div class="showcase">
                  
                  <div class="showcase-banner">
                    <img src="../admin/<?php echo $row['product_image']; ?>" alt="shampoo, conditioner & facewash packs" class="showcase-img">
                  </div>

                  <div class="showcase-content">
                    
                    <!-- <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-outline"></ion-icon>
                      <ion-icon name="star-outline"></ion-icon>
                    </div> -->

                
                      <h3 class="showcase-title"><?php echo $row['product_name'] ?></h3>
             

                    <p class="showcase-desc">
                     <?php echo $row['product_description'] ?>
                    </p>

                    <div class="price-box">
                      <p class="price">₱<?php echo $row['product_price'] ?></p>

                  
                    </div>
                    <div class="counter">
                    <h1 class="minus">-</h1>
                     <input type="number" value="1" min="1" class="quantity" readonly name="product_quantity">
                    <h1 class="plus">+</h1>
                    </div>
                    <br>


                    
                    <button  class="add-cart-btn" name="addtocart">add to cart</button>
<!-- 
                    <div class="showcase-status">
                      <div class="wrapper">
                        <p>
                          already sold: <b>20</b>
                        </p>

                        <p>
                          available: <b>40</b>
                        </p>
                      </div>

                      <div class="showcase-status-bar"></div>
                    </div> -->


                  </div>

                </div>

              </div>

          


            
            </div>

          </div>
          </form>
            <?php }?>




<?php if (isset($_GET['cart'])): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    <?php if ($_GET['cart'] === 'success'): ?>
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Product added to cart!",
        showConfirmButton: false,
        timer: 1500
      });
    <?php elseif ($_GET['cart'] === 'error'): ?>
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: "Failed to add to cart",
        text: "<?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'An error occurred.'; ?>",
        showConfirmButton: false,
        timer: 2000
      });
    <?php endif; ?>

    // Remove ?cart=... from URL after showing the alert
    window.addEventListener('DOMContentLoaded', function() {
      if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('cart');
        url.searchParams.delete('msg');
        window.history.replaceState({}, document.title, url.pathname + url.search);
      }
    });
  </script>
<?php endif; ?>


              
                  

   


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






