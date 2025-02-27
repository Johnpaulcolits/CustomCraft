<?php
include_once "../php/config.php";


if (isset($_POST['order'])) {
    if (!empty($_POST['product_ids'])) {
        foreach ($_POST['product_ids'] as $key => $product_id) {
            $quantity = $_POST['quantities'][$key];
            
            // Get product details
            $result = $conn->query("SELECT * FROM cart WHERE cart_id = $product_id");
            $row = $result->fetch_assoc();

            // Insert into orders table
            $stmt = $conn->prepare("INSERT INTO orders (product_name, product_image, product_price, product_quantity) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssdi', $row['product_name'], $row['product_image'], $row['product_price'], $quantity);
            $stmt->execute();
        }
        echo "<p>Order placed successfully!</p>";
    } else {
        echo "<p>Please select at least one product.</p>";
    }
}


?>