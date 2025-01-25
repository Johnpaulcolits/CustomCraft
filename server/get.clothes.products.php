<?php
include_once "php/config.php";


$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='shirt' LIMIT 4");

$stmt->execute();


$clothes_products = $stmt->get_result();




?>