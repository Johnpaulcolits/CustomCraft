
<?php

include_once "../php/config.php";


if (isset($_POST['add_to_cart'])) {
    // Assuming a valid database connection $conn
    $unique_id = $conn->real_escape_string($_POST['unique_id']);
    $product_id = $conn->real_escape_string($_POST['product_id']);
    $product_image = $conn->real_escape_string($_POST['product_image']);
    $product_name = $conn->real_escape_string($_POST['product_name']);
    $product_price = $conn->real_escape_string($_POST['product_price']);
    $product_quantity = $conn->real_escape_string($_POST['product_quantity']);
    
    // Insert into cart table
    $sql = "INSERT INTO cart (unique_id, product_id, product_image, product_name, product_price, product_quantity) 
            VALUES ('$unique_id', '$product_id', '$product_image', '$product_name', '$product_price', '$product_quantity')";
    
    if ($conn->query($sql) === TRUE) {
        // Return a success response
        echo json_encode(['success' => true, 'message' => 'Product added to cart successfully!']);
    } else {
        // Return an error response
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
}
?>

