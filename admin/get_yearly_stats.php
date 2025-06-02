<?php
include_once "../php/config.php";

$currentYear = date('Y');
$labels = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$data = array_fill(1, 12, 0);

$sql = "SELECT MONTH(order_date) as month, SUM(subtotal) as revenue
        FROM orders
        WHERE YEAR(order_date) = $currentYear
        GROUP BY MONTH(order_date)";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $data[(int)$row['month']] = (float)$row['revenue'];
}

echo json_encode([
    'labels' => $labels,
    'data' => array_values($data)
]);


