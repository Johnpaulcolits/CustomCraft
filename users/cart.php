<?php
session_start();
include_once "../php/config.php";

// session_start();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
  header("Location: ../login.php"); // Redirect unauthorized users
  exit();
}

if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
  }
  
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
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
    <title>My Cart</title>
    <link rel="shortcut icon" href="../admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="./assets/css/home.css" />
    <!--
    - custom css link
  -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!--
  - google font link
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
      <i class="fab fa-facebook-messenger" style="font-size: 30x; color: #0084ff;"></i>

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
       
      <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image" onclick="toggleMenus()" id="profiles">
           <div class="sub-menu-wrap" id="subMenus">
              <div class="sub-menu">
                <div class="user-info">
                <img src="../php/images/<?php echo $row['img'] ?>" class="profile-image">
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

  <style>
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .display-container{
            margin-top: 220px;
        }
        .custom-checkbox {
  width: 20px; /* Fixed width */
  height: 20px; /* Fixed height */
  min-width: 20px; /* Ensures it won’t shrink */
  min-height: 20px;
  margin-right: 7px;


}


      
       
    </style>
 
<?php

include_once "../php/config.php";

$user_id = $_SESSION['unique_id']; // Assuming user is logged in

// Query to check if the cart has items
$sql = "SELECT COUNT(*) as count FROM cart WHERE unique_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id); // Change "i" to "s" if unique_id is a string
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    echo '
    <div class="display-container  ">
        <div class="disply-info">
            <img src="https://img.icons8.com/?size=100&id=80832&format=png&color=000000" alt="">
        </div>
        <div class="disply-info">
            <p class="shopping-info">Your Shopping Cart is Empty</p>
        </div>
        <div class="disply-info">
            <button class="btn-shop" onclick="window.location.href=\'index.php\'">Go Shopping Now</button>
        </div>
    </div>';
} else {
    $stmt = $conn->prepare("SELECT * FROM cart WHERE unique_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $cart = $stmt->get_result();
    ?>

    <div class="container mt-4 ">
        <h4>Shopping Cart</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="card p-3">
                <form action="checkout.php" method="post">
    <input type="hidden" name="unique_id" value="<?php echo $user_id; ?>">
    
    <?php while ($row = $cart->fetch_assoc()) { ?>
        <div class="cart-item d-flex align-items-center border rounded-3 p-3 mb-3 shadow-sm">
    <input class="form-check-input custom-checkbox me-3" type="checkbox" name="product_ids[]" value="<?php echo $row['cart_id']; ?>">

    <!-- Hidden fields for product data -->
    <input type="hidden" name="product_ids_full[]" value="<?php echo $row['cart_id']; ?>">
    <input type="hidden" name="product_ids_actual[]" value="<?php echo $row['product_id']; ?>">
    <input type="hidden" name="product_names[]" value="<?php echo $row['product_name']; ?>">
    <input type="hidden" name="product_images[]" value="<?php echo $row['product_image']; ?>">
    <input type="hidden" name="product_prices[]" value="<?php echo $row['product_price']; ?>">

    <img src="../admin/<?php echo $row['product_image']; ?>" class="rounded me-3" width="60" height="60" style="object-fit: cover;">

    <div class="flex-grow-1">
        <h6 class="mb-1 fw-bold text-primary"><?php echo $row['product_name']; ?></h6>
        <p class="text-muted mb-0">₱<?php echo number_format($row['product_price'], 2); ?></p>
    </div>

    <div class="d-flex align-items-center">
        <input type="number" class="form-control text-center me-2" name="quantities[]" value="<?php echo $row['product_quantity']; ?>" style="width: 70px;">
        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row['cart_id']; ?>">
            <i class="bi bi-trash"></i> Delete
        </button>
    </div>
</div>
    <?php } ?>
    
    <!-- Place Order Button -->
<div class="text-end mt-4">
    <input type="submit" name="order" value="Place Order" class="btn btn-success btn-lg rounded-pill px-4 py-2 fw-bold shadow">
</div>
</form>


                </div>
            </div>

          
        </div>
    </div>



    
 <script>





//Delete Product
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-delete").forEach(button => {
        button.addEventListener("click", function () {
            let cartId = this.getAttribute("data-id");

            if (confirm("Are you sure you want to delete this item?")) {
                fetch("./phpController/deletecart.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ cart_id: cartId })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    localStorage.removeItem('cartState'); // Reset local storage
                    location.reload(); // Refresh after deletion
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});











</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const quantityInputs = document.querySelectorAll('.quantity');

        quantityInputs.forEach(input => {
            input.addEventListener('change', function() {
                const cartId = this.closest('.cart-item').querySelector('.btn-delete').getAttribute('data-id');
                const newQuantity = this.value;

                if (newQuantity > 0) {
                    updateQuantity(cartId, newQuantity);
                } else {
                    alert('Quantity must be at least 1');
                    this.value = this.getAttribute('data-original-quantity');
                }
            });
        });

        function updateQuantity(cartId, quantity) {
            fetch('update_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `cart_id=${cartId}&quantity=${quantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('total-price').innerText = data.new_total;
                } else {
                    alert('Failed to update quantity');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
</script>


    <?php
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<?php if (isset($_GET['order'])): ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    <?php if ($_GET['order'] === 'success'): ?>
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Order placed successfully!",
        showConfirmButton: false,
        timer: 1500
      });
    <?php elseif ($_GET['order'] === 'error'): ?>
      Swal.fire({
        position: "top-end",
        icon: "error",
        title: "Failed to place order",
        text: "<?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'An error occurred.'; ?>",
        showConfirmButton: false,
        timer: 2000
      });
    <?php endif; ?>

    // Remove ?order=... from URL after showing the alert
    window.addEventListener('DOMContentLoaded', function() {
      if (window.history.replaceState) {
        const url = new URL(window.location);
        url.searchParams.delete('order');
        url.searchParams.delete('msg');
        window.history.replaceState({}, document.title, url.pathname + url.search);
      }
    });
  </script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>











