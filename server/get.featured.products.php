<?php
include_once "php/config.php";


$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();


$featured_products = $stmt->get_result();




?>