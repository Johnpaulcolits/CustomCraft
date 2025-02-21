<?php
session_start();
include '../../php/config.php'; // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addtocart'])) {
    if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_description'], $_POST['product_price'], $_POST['unique_id'], $_POST['product_quantity'], $_POST['product_image'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = $_POST['product_price'];
        $unique_id = $_POST['unique_id'];
        $product_quantity = $_POST['product_quantity'];
        $product_image = $_POST['product_image']; // New field added

        // Check if the product already exists in the cart
        $query = "SELECT product_quantity FROM cart WHERE product_id = ? AND unique_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $product_id, $unique_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // If product exists, update the quantity
            $stmt->bind_result($existing_quantity);
            $stmt->fetch();
            $new_quantity = $existing_quantity + $product_quantity;

            $update_query = "UPDATE cart SET product_quantity = ? WHERE product_id = ? AND unique_id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("iis", $new_quantity, $product_id, $unique_id);

            if ($update_stmt->execute()) {
                echo "<script>alert('Product quantity updated in cart.'); window.location.href = '../single.product.php';</script>";
            } else {
                echo "<script>alert('Error: " . $update_stmt->error . "'); window.location.href = '../single.product.php';</script>";
            }
            $update_stmt->close();
        } else {
            // If product does not exist, insert it
            $insert_query = "INSERT INTO cart (product_id, product_name, product_description, product_price, unique_id, product_quantity, product_image) 
                             VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_query);
            $insert_stmt->bind_param("issdsis", $product_id, $product_name, $product_description, $product_price, $unique_id, $product_quantity, $product_image);

            if ($insert_stmt->execute()) {
                echo "<script>alert('Product successfully added to cart.'); window.location.href = '../single.product.php';</script>";
            } else {
                echo "<script>alert('Error: " . $insert_stmt->error . "'); window.location.href = '../single.product.php';</script>";
            }
            $insert_stmt->close();
        }

        $stmt->close();
    } else {
        echo "<script>alert('Missing required fields.'); window.location.href = '../single.product.php';</script>";
    }

    $conn->close();
}

?>
