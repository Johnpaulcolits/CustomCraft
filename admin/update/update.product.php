<?php
// Handle form submission for updating a product
if (isset($_POST['updateproduct'])) {
    require '../../php/config.php'; // Ensure database connection is included

    $product_id = $_POST['product_id'];
    $product_name = trim($_POST['product_name']);
    $product_category = trim($_POST['product_category']);
    $product_description = trim($_POST['product_description']);
    $product_price = $_POST['product_price'];
    $product_special_offer = $_POST['product_special_offer'] ?? 0;
    $product_color = trim($_POST['product_color']);

    // Image Upload Directory
    $target_dir = "../imgproducts/";
    
    // Ensure directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Function to handle image upload
    function uploadImage($file, $target_dir, $existing_image) {
        if (!empty($file['name'])) {
            $file_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (!in_array(strtolower($file_ext), $allowed_types)) {
                die("Error: Only JPG, JPEG, PNG & GIF files are allowed.");
            }
            
            // Generate unique filename
            $unique_name = uniqid() . "." . $file_ext;
            $target_file = $target_dir . $unique_name;
            
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                if (!empty($existing_image) && file_exists($existing_image)) {
                    unlink($existing_image); // Remove old image
                }
                return $target_file;
            } else {
                die("Error uploading image.");
            }
        }
        return $existing_image; // Keep the old image if no new image uploaded
    }

    // Fetch existing images
    $query = "SELECT product_image, product_image2, product_image3, product_image4 FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($existing_image1, $existing_image2, $existing_image3, $existing_image4);
    $stmt->fetch();
    $stmt->close();

    // Process image uploads
    $product_image = uploadImage($_FILES['product_image'], $target_dir, $existing_image1);
    $product_image2 = uploadImage($_FILES['product_image2'], $target_dir, $existing_image2);
    $product_image3 = uploadImage($_FILES['product_image3'], $target_dir, $existing_image3);
    $product_image4 = uploadImage($_FILES['product_image4'], $target_dir, $existing_image4);

    // Update the product in the database
    $sql = "UPDATE products SET product_name=?, product_category=?, product_description=?, product_image=?, product_image2=?, product_image3=?, product_image4=?, product_price=?, product_special_offer=?, product_color=? WHERE product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssdisi", $product_name, $product_category, $product_description, $product_image, $product_image2, $product_image3, $product_image4, $product_price, $product_special_offer, $product_color, $product_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully!'); window.location.href='../product.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>