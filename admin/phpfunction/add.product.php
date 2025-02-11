<?php

include_once "../../php/config.php";





// Handle form submission
if (isset($_POST['addproduct'])) {
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_special_offer = $_POST['product_special_offer'] ?? 0;
    $product_color = $_POST['product_color'];

    // Image Upload Directory
    $target_dir = "imgproducts/";

    // Ensure directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Function to upload images
    function uploadImage($file, $target_dir) {
        if (!empty($file['name'])) {
            $file_ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            // Validate file type
            if (!in_array(strtolower($file_ext), $allowed_types)) {
                die("Error: Only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Generate unique filename
            $unique_name = uniqid() . "." . $file_ext;
            $target_file = $target_dir . $unique_name;

            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file; // Return the stored path
            } else {
                die("Error uploading image.");
            }
        }
        return "";
    }

    // Upload product images
    $product_image = uploadImage($_FILES['product_image'], $target_dir);
    $product_image2 = uploadImage($_FILES['product_image2'], $target_dir);
    $product_image3 = uploadImage($_FILES['product_image3'], $target_dir);
    $product_image4 = uploadImage($_FILES['product_image4'], $target_dir);

    // SQL Insert Query
    $sql = "INSERT INTO products (product_name, product_category, product_description, product_image, product_image2, product_image3, product_image4, product_price, product_special_offer, product_color)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssdis", $product_name, $product_category, $product_description, $product_image, $product_image2, $product_image3, $product_image4, $product_price, $product_special_offer, $product_color);

    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!'); window.location.href='';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>