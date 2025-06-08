<?php
include "../php/config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['unique_id'];
$query = "SELECT * FROM users WHERE unique_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (empty($user['phone_number']) || empty($user['address'])): ?>
    <div class="alert alert-warning text-center" role="alert">
        Please complete your profile by adding your phone number and address before proceeding to checkout.
    </div>
    <script>setTimeout(() => window.location.href = 'settings.php', 4000);</script>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../admin/assets/images/logo/icon-logo.png" type="image/x-icon">
    <style>
        .cart-item img { width: 80px; height: 80px; object-fit: cover; }
        .checkout-summary { max-width: 800px; margin: auto; }
    </style>
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
            <a href="customize.php" class="menu-title">CREATE YOURS</a>
          </li>
          <li class="menu-category">
            <a href="orders.php" class="menu-title">MY ORDER</a>
          </li>

        </ul>

      </div>

    </nav>


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
          <a href="customize.php" class="menu-title">Create Yours</a>
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

<div class="container checkout-summary my-5">
    <h2 class="text-center mb-4">Checkout Summary</h2>
    <div class="card p-4 mb-4">
        <h5><strong>Delivery Address:</strong></h5>
        <p><?php echo htmlspecialchars($user['fname'] . ' ' . $user['lname']); ?> (+63) <?php echo htmlspecialchars($user['phone_number']); ?><br>
        <?php echo htmlspecialchars($user['address']); ?></p>
    </div>

<?php if (isset($_POST['order'])): ?>
    <?php
    $selected_cart_ids = $_POST['product_ids'] ?? [];
$all_cart_ids = $_POST['product_ids_full'] ?? [];
$all_product_ids = $_POST['product_ids_actual'] ?? [];
$product_names = $_POST['product_names'] ?? [];
$product_images = $_POST['product_images'] ?? [];
$product_prices = $_POST['product_prices'] ?? [];
$quantities = $_POST['quantities'] ?? [];
$total = 0;
$shipping_fee = 29;

// Build arrays for only the selected products
$final_product_ids = [];
$final_quantities = [];
$final_product_prices = [];
foreach ($all_cart_ids as $index => $cart_id) {
    if (!in_array($cart_id, $selected_cart_ids)) continue;
    $final_product_ids[] = $all_product_ids[$index]; // <-- Use product_id, not cart_id
    $final_quantities[] = (int)$quantities[$index];
    $final_product_prices[] = (float)$product_prices[$index];
}
    ?>

    <?php if (!empty($selected_cart_ids)): ?>
        <div class="row">
            <?php foreach ($all_cart_ids as $index => $cart_id): ?>
                <?php if (!in_array($cart_id, $selected_cart_ids)) continue; ?>
                <?php
                $product_name = htmlspecialchars($product_names[$index]);
                $product_image = htmlspecialchars($product_images[$index]);
                $product_price = (float)$product_prices[$index];
                $quantity = (int)$quantities[$index];
                $subtotal = $product_price * $quantity;
                $total += $subtotal;
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="../admin/<?= $product_image ?>" class="card-img-top" alt="<?= $product_name ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product_name ?></h5>
                            <p class="card-text">Unit Price: ₱<?= number_format($product_price, 2) ?></p>
                            <p class="card-text">Quantity: <?= $quantity ?></p>
                            <p class="card-text"><strong>Subtotal: ₱<?= number_format($subtotal, 2) ?></strong></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="card p-4 mt-4">
            <p>Shipping Option: Standard Local (₱<?= number_format($shipping_fee, 2) ?>)</p>
            <h3>Order Total: ₱<?= number_format($total + $shipping_fee, 2) ?></h3>
            <form action="./phpController/check_function.php" method="post">
                <input type="hidden" name="unique_id" value="<?= htmlspecialchars($user_id) ?>">
                <input type="hidden" name="total" value="<?= $total ?>">
                <input type="hidden" name="shipping_fee" value="<?= $shipping_fee ?>">
                <input type="hidden" name="selected_cart_ids" value='<?= json_encode($selected_cart_ids) ?>'>
                <input type="hidden" name="product_ids" value='<?= json_encode($final_product_ids) ?>'>
                <input type="hidden" name="quantities" value='<?= json_encode($final_quantities) ?>'>
                <input type="hidden" name="product_prices" value='<?= json_encode($final_product_prices) ?>'>
                <button type="submit" name="order" class="btn btn-primary w-100 mt-3">Place Order</button>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No products selected.</div>
        <script>setTimeout(() => window.location.href = 'cart.php', 1500);</script>
    <?php endif; ?>
<?php endif; ?>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php endif; ?>