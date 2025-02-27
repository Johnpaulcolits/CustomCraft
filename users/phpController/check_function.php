<?php

include_once "../../php/config.php";

if (isset($_POST['order'])) {
    $unique_id = $_POST['unique_id'] ?? null;
    $total = (float)$_POST['total'];
    $shipping_fee = (float)$_POST['shipping_fee'];
    $selected_cart_ids = json_decode($_POST['selected_cart_ids'], true);
    $product_ids = json_decode($_POST['product_ids'], true);
    $quantities = json_decode($_POST['quantities'], true);
    $product_prices = json_decode($_POST['product_prices'], true);
    $total_amount = $total + $shipping_fee;

    if ($unique_id && !empty($selected_cart_ids) && !empty($product_ids) && !empty($quantities) && !empty($product_prices)) {
        $order_placed = false;

        foreach ($selected_cart_ids as $index => $cart_id) {
            $product_id = $product_ids[$index] ?? null;
            $quantity = (int)($quantities[$index] ?? 0);
            $product_price = (float)($product_prices[$index] ?? 0);
            $subtotal = $product_price * $quantity;

            if ($product_id && $quantity > 0) {
                $stmt = $conn->prepare("INSERT INTO orders (unique_id, product_id, quantity, price, subtotal, shipping_fee, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssiddid", $unique_id, $product_id, $quantity, $product_price, $subtotal, $shipping_fee, $total_amount);
                if ($stmt->execute()) {
                    $order_placed = true;
                }
            }
        }

        if ($order_placed) {
            $delete_stmt = $conn->prepare("DELETE FROM cart WHERE unique_id = ?");
            $delete_stmt->bind_param("s", $unique_id);
            $delete_stmt->execute();
            $delete_stmt->close();

            echo "<div class='alert alert-success'>Order placed successfully and cart cleared!</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to place order.</div>";
        }

        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    } else {
        echo "<div class='alert alert-danger'>No items to order or missing data.</div>";
    }
}
?>