<?php
include "../php/config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
    header('Location: ../login.php');
    exit();
}



$user_id = $_SESSION['unique_id'];

// Fetch the checked items from localStorage (passed via POST)
$checkedItems = json_decode($_POST['checkedItems'], true);

if(!$checkedItems){
header('Location: cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=USD"></script>
    <link rel="shortcut icon" href="../admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
</head>
<body>

<?php


// Fetch user info
$userId = $_SESSION['unique_id']; // Assuming user is logged in
$query = "SELECT * FROM users WHERE unique_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (empty($row['phone_number']) || empty($row['address'])): ?>
    <div class="alert alert-warning text-center" role="alert">
        Please complete your profile by adding your phone number and address before proceeding to checkout.
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'settings.php';
        }, 4000);
    </script>
<?php else: ?>
    <div class="container mt-5">
        <!-- User Information -->
        <div class="card p-3 mb-4">
            <h5>User Information</h5>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
        </div>

        <h2>Checkout</h2>
        <div class="card p-3">
            <ul class="list-group">
                <?php $total = 0; ?>
                <?php foreach ($checkedItems as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6><?php echo htmlspecialchars($item['product']); ?></h6>
                            <p>₱<?php echo number_format($item['price'], 2); ?> x <?php echo (int)$item['quantity']; ?></p>
                        </div>
                        <strong>₱<?php echo number_format($item['price'] * $item['quantity'], 2); ?></strong>
                    </li>
                    <?php $total += $item['price'] * $item['quantity']; ?>
                <?php endforeach; ?>
            </ul>
            <h4 class="mt-3">Total: ₱<?php echo number_format($total, 2); ?></h4>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <form action="./phpController/placeOrder.php" method="POST">
                <input type="hidden" name="payment_method" value="cod">
                <input type="hidden" name="checked_items" value='<?php echo json_encode($checkedItems); ?>'>
                <button type="submit" class="btn btn-success">Cash on Delivery</button>
            </form>

            <div id="paypal-button-container"></div>
        </div>
    </div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo number_format($total, 2); ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    fetch('./phpController/placeOrder.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            payment_method: 'paypal',
                            checked_items: <?php echo json_encode($checkedItems); ?>,
                            transaction_id: details.id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        window.location.href = 'orderConfirmation.php';
                    })
                    .catch(error => console.error('Error:', error));
                });
            }
        }).render('#paypal-button-container');
    </script>
<?php endif; ?>



</body>
</html>
