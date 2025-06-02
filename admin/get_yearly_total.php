<?php
include_once "../php/config.php";
$currentYear = date('Y');
$sql = "SELECT SUM(subtotal) AS total FROM orders WHERE YEAR(order_date) = $currentYear";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total = $row['total'] ? $row['total'] : 0;
echo $total;