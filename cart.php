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
            cart_id,
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






// Check if the form was submitted


// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
//   $_SESSION['checkout_allowed'] = true; // Set the flag to allow checkout
//   header('Location: checkout.php');
//   exit;
// }


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
                <a class="nav-link" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
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

   <!-- Cart -->
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
                $cartid = $row['cart_id'];
                $_SESSION['cart_total'] = $total; // Save total amount in session
                $_SESSION['cartid'] = $cartid; // Save cart ID in session
            ?>
            <tr id="product-<?php echo $row['cart_id']; ?>"> <!-- Assign a unique ID to the product row -->
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="Product Image">
                        <div>
                            <p><?php echo $row['product_name']; ?></p>
                            <small><span>₱</span><?php echo $row['product_price']; ?></small>
                            <br>
                            <form class="delete-form" data-cart-id="<?php echo $row['cart_id']; ?>"> <!-- Use a data attribute to store cart ID -->
                                <input type="submit" class="remove-btn" value="Delete" name="delete-product"/>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="number" value="<?php echo $row['total_quantity']; ?>">
                    <a href="#" class="edit-btn">Edit</a>
                </td>
                <td>
                    <span>₱</span>
                    <span class="product-price"><?php echo $row['total_quantity'] * $row['product_price']?></span>
                </td>
            </tr>
            <?php } ?>
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



</script>

<script>
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});

document.querySelectorAll(".delete-form").forEach(form => {
    form.addEventListener("submit", async function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData();
        formData.append("delete-product", true);
        const cartId = this.getAttribute("data-cart-id"); // Get the cart ID from the data attribute

        try {
            const response = await fetch("server/upload.cart.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json(); // Parse the JSON response

            if (result.success) {
                // Show success toast
                Toast.fire({
                    icon: "success",
                    title: result.message // Success message
                });

                // Find the product row with the corresponding cart ID and remove it
                const productRow = document.getElementById(`product-${cartId}`); // Target the specific product row
                if (productRow) {
                    productRow.remove(); // Remove the product row from the DOM
                }

                // Update the total
                updateCartTotal(); // Call the function to update the cart total
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: result.message, // Display error message
                });
            }
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Network Error",
                text: "An error occurred: " + error.message, // Handle network errors
            });
        }
    });
});

// Function to update the cart total after a product is deleted
function updateCartTotal() {
    let total = 0;
    const productRows = document.querySelectorAll("tr[id^='product-']"); // Select all product rows

    // Loop through each product row to recalculate the total
    productRows.forEach(row => {
        const productPrice = parseFloat(row.querySelector(".product-price").innerText.replace('₱', ''));
        const quantity = parseInt(row.querySelector("input[type='number']").value, 10);
        total += productPrice * quantity; // Add the product total to the running total
    });

    // Update the total in the cart total section
    const cartTotalElement = document.querySelector(".cart-total td:last-child");
    if (cartTotalElement) {
        cartTotalElement.innerText = `₱${total.toFixed(2)}`; // Update the total with 2 decimal places
    }
}



</script>
