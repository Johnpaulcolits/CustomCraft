<?php

session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: login.php");
}

include_once "php/config.php";
// Get the unique_id of the logged-in user
$unique_id = $_SESSION['unique_id'] ?? null;

if($unique_id){
$stmt = $conn->prepare(" SELECT 
            unique_id,
            product_id,
            product_name,
            product_image,
            product_price,
            SUM(product_quantity) AS total_quantity
        FROM cart 
        WHERE unique_id = ? 
        GROUP BY product_id");

if($stmt){
  $stmt->bind_param("i",$unique_id);
  $stmt->execute();
  
  $cart = $stmt->get_result();
}
}



if (isset($_POST['delete-product'])) {
  if (isset($_SESSION['unique_id'])) {
      // Get the unique_id from the session
      $unique_id = $_SESSION['unique_id'];

      // Ensure $conn is valid
      if ($conn instanceof mysqli) {
          // Prepare the DELETE query for all rows with the same unique_id
          $stmt = $conn->prepare("DELETE FROM cart WHERE unique_id = ?");
          $stmt->bind_param("s", $unique_id);

          // Execute the query
          if ($stmt->execute()) {
              // Success message
              echo "<script>alert('All items with unique_id $unique_id were deleted successfully.');</script>";
          } else {
              // Log the error and show a generic message to the user
              error_log("Error deleting items: " . $stmt->error); // Logs error for debugging
              echo "<script>alert('An error occurred while deleting items.');</script>";
          }

          // Close the statement
          $stmt->close();

          // Close the database connection
          $conn->close();
      } else {
          echo "<script>alert('Database connection failed.');</script>";
      }
  } else {
      echo "<script>alert('No unique_id in session.');</script>";
  }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css" integrity="sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/imgs/icon-logo.png" type="image">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

      <!--Cart-->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>

            <table class="mt-5 pt-5">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <?php 
                $total = 0; // Initialize total variable
                while($row =$cart->fetch_assoc()) { 
                  // Calculate the product's total price
    $productTotal = $row['total_quantity'] * $row['product_price']; 
    $total += $productTotal; // Add to the running total

    ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="assets/imgs/<?php echo $row['product_image']; ?>" >
                            <div>
                                <p><?php echo $row['product_name']; ?></p>
                                <small><span>₱</span><?php echo $row['product_price']; ?></small>
                                <br>
                                <form method="POST" action="cart.php">
                                 <input type="submit" class="remove-btn" value="Delete" name="delete-product">
                                  </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="number" value="<?php echo $row['total_quantity']; ?>">
                        <a href="#" class="edit-btn" >Edit</a>
                    </td>
                    <td>
                        <span>₱</span>
                        <span class="product-price"><?php echo $row['total_quantity'] * $row['product_price']?></span>
                    </td>
                </tr>
                <?php }?>
            </table>

            <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <td>₱<?php echo $total; ?></td>
            </tr>

           
        </table>
            </div>
           

        </div>
        <div class="checkout-container">
                  <form action="checkout.php" method="POST">
                  <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
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
</html>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const removeButtons = document.querySelectorAll('.remove-btn');

    removeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior

            const cartId = button.getAttribute('data-cart-id'); // Get the cart_id from data attribute

            if (cartId) {
                // Send the POST request to delete the cart item
                fetch('cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ 'cart_id': cartId }).toString() // Properly encode the body
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success Toast
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
                        Toast.fire({
                            icon: "success",
                            title: data.message // Message from PHP
                        });

                        button.closest('tr').remove(); // Remove the row from the table
                    } else {
                        // Error Toast
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
                        Toast.fire({
                            icon: "error",
                            title: data.message // Message from PHP
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});

    </script>