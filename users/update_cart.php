<?php
include '../php/config.php'; // Adjust your DB connection path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE cart SET product_quantity = ? WHERE cart_id = ?");
    $stmt->bind_param('ii', $quantity, $cart_id);

    if ($stmt->execute()) {
        // Recalculate total price
        $result = $conn->query("SELECT SUM(product_price * product_quantity) AS total FROM cart");
        $total = $result->fetch_assoc()['total'];
        echo json_encode(['success' => true, 'new_total' => $total]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>