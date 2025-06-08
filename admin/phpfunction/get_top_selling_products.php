<?php
include_once "../../php/config.php";

$range = isset($_GET['range']) ? $_GET['range'] : 'monthly';

$where = "";
if ($range === 'monthly') {
    $where = "WHERE MONTH(o.order_date) = MONTH(CURRENT_DATE()) AND YEAR(o.order_date) = YEAR(CURRENT_DATE())";
} elseif ($range === 'yearly') {
    $where = "WHERE YEAR(o.order_date) = YEAR(CURRENT_DATE())";
}

$sql = "
SELECT p.product_name, SUM(o.quantity) AS total_sold
FROM orders o
JOIN products p ON o.product_id = p.product_id
$where
GROUP BY o.product_id, p.product_name
ORDER BY total_sold DESC
LIMIT 5
";
$result = $conn->query($sql);

$labels = [];
$data = [];
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['product_name'];
    $data[] = (int)$row['total_sold'];
}
echo json_encode([
    "labels" => $labels,
    "data" => $data
]);
?>