<?php
session_start();
include_once "../php/config.php";

// session_start();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
  header("Location: ../login.php"); // Redirect unauthorized users
  exit();
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
  
  <style>
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .display-container{
            margin-top: 220px;
        }
    </style>
</head>
<body>



 
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
    <div class="display-container">
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

    <div class="container mt-4">
        <h4>Shopping Cart</h4>
        <div class="row">
            <div class="col-md-8">
                <div class="card p-3">
                    <?php while ($row = $cart->fetch_assoc()) { ?>
                        <div class="cart-item d-flex align-items-center border-bottom pb-2 mb-2">
    <input class="form-check-input me-3" type="checkbox">
    <img src="../admin/<?php echo $row['product_image']; ?>" class="me-3">
    <div class="flex-grow-1">
        <h6><?php echo $row['product_name']; ?></h6>
        <p class="text-muted">₱<?php echo $row['product_price']; ?></p>
    </div>
    <div>
        <input type="number" class="form-control quantity"
            value="<?php echo $row['product_quantity']; ?>"
            data-original-quantity="<?php echo $row['product_quantity']; ?>"
            min="<?php echo $row['product_quantity']; ?>"
            style="width: 60px;">
    </div>
    <button class="btn btn-danger btn-delete ms-2" data-id="<?php echo $row['cart_id']; ?>">Delete</button>

</div>

                    <?php } ?>
                </div>
            </div>

            <!-- Order Summary (Outside the Loop) -->
            <div class="col-md-4">
                <div class="card p-3">
                    <h5>Order Summary</h5>
                    <p>Total: <strong>₱<span id="total-price">0</span></strong></p>
                    <button class="btn btn-primary w-100">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    loadCartState();

    document.querySelectorAll('.quantity, input[type=checkbox]').forEach(input => {
        input.addEventListener('change', function () {
            validateQuantity(this); // Ensure the quantity is not below original
            saveCartState();
            updateTotal();
        });
    });
});

function saveCartState() {
    let cartState = [];
    document.querySelectorAll('.cart-item').forEach(item => {
        let checkbox = item.querySelector('input[type=checkbox]');
        let quantityInput = item.querySelector('.quantity');
        let productName = item.querySelector('h6').textContent;

        cartState.push({
            product: productName,
            checked: checkbox.checked,
            quantity: quantityInput.value
        });
    });
    localStorage.setItem('cartState', JSON.stringify(cartState));
}

function loadCartState() {
    let cartState = JSON.parse(localStorage.getItem('cartState'));
    if (!cartState) return;

    document.querySelectorAll('.cart-item').forEach(item => {
        let productName = item.querySelector('h6').textContent;
        let checkbox = item.querySelector('input[type=checkbox]');
        let quantityInput = item.querySelector('.quantity');

        let savedItem = cartState.find(cart => cart.product === productName);
        if (savedItem) {
            checkbox.checked = savedItem.checked;
            quantityInput.value = savedItem.quantity;
        }
    });

    updateTotal();
}

function validateQuantity(input) {
    let originalQuantity = parseInt(input.getAttribute('data-original-quantity'));
    let newValue = parseInt(input.value);

    if (newValue < originalQuantity) {
        input.value = originalQuantity; // Prevent decreasing below the original quantity
    }
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        if (item.querySelector('input[type=checkbox]').checked) {
            let price = parseFloat(item.querySelector('p.text-muted').textContent.replace('₱', ''));
            let quantity = parseInt(item.querySelector('.quantity').value);
            total += price * quantity;
        }
    });
    document.getElementById('total-price').textContent = total.toFixed(2);
}






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


    <?php
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>