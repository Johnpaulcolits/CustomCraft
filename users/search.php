<?php
session_start();
include_once "../php/config.php";

// session_start();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
  header("Location: ../login.php"); // Redirect unauthorized users
  exit();
}


// Redirect to index.php if no search term is provided
$search = isset($_GET['search']) ? $_GET['search'] : '';
if (empty($search)) {
    header("Location: index.php");
    exit();
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






  <!--
    - NOTIFICATION TOAST
  -->





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
            <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image" onclick="toggleMenu()" id="profile">
           <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                <div class="user-info">
                <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image">
                <h2 class="user-name"><?php echo $row['fname'] ?></h2>
                </div>
                <hr>

                <a href="#" class="sub-menu-link">
                  <img src="./assets/images/profile/profile.png">
                  <p class="letter-p-1">Edit Profile</p>
                  <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
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

       <a href="../users.php">   <button class="action-btn">
       <i class="fab fa-facebook-messenger" style="font-size: 30x; color: #0084ff;"></i>
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
            <ion-icon name="bag-handle-outline"></ion-icon>
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

         

         
          

          <li class="menu-category">
            <a href="customize.php" class="menu-title">CREATE YOUR'S</a>
          </li>

        </ul>

      </div>

    </nav>

    <div class="mobile-bottom-navigation">

    
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
      <i class="fab fa-facebook-messenger" style="font-size: 30x; color: #0084ff;"></i>

        <!-- <span class="count">0</span> -->
      </button>
    </a>

     
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
       
      <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image" onclick="toggleMenus()" id="profiles">
           <div class="sub-menu-wrap" id="subMenus">
              <div class="sub-menu">
                <div class="user-info">
                <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image">
                <h2 class="user-name"><?php echo $row['fname'] ?></h2>
                </div>
                <hr>

                <a href="#" class="sub-menu-link">
                  <img src="./assets/images/profile/profile.png">
                  <p class="letter-p-1">Edit Profile</p>
                  <span>></span>
                </a>
                <a href="#" class="sub-menu-link">
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
          <a href="customize.php" class="menu-title">Create Your's</a>
        </li>

    <!-- diara -->
     
        <li class="menu-category">

          <button class="accordion-menu" data-accordion-btn>
            <p class="menu-title">Clothes</p>

            <div>
              <ion-icon name="add-outline" class="add-icon"></ion-icon>
              <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
            </div>
          </button>

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

        

          </ul>



       
        <ul class="menu-social-container">

          <li>
            <a href="https://www.facebook.com/justine.francisco.1481" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

       

        </ul>

      </div>

    </nav>

  </header>





  <!--
    - MAIN
  -->

  <main>






    <!--
      - CATEGORY
    -->

    <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

        

        </div>

      </div>

    </div>





    <!--
      - PRODUCT
    -->

    <div class="product-container">

      <div class="container">






        <div class="product-box">

       



          <!--
            - PRODUCT FEATURED
          -->




          <!--
            - PRODUCT GRID
          -->

       

          <div class="product-main">

            <h2 class="title">Products</h2>

            <div class="product-grid">
           

              <?php



// Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';



$sql = "SELECT * FROM products WHERE product_name LIKE ? OR product_description LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
// Display results
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>

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

   

      <div class="price-box">
        <p class="price">₱<?php echo $row['product_price']; ?></p>
      </div>
    </div>
  </div>
  </a>

<?php

        
    }
} else {
    echo "<p>No products found.</p>";
}

$stmt->close();
$conn->close();


?>

           

            </div>

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






