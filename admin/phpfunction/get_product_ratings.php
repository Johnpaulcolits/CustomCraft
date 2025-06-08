<?php
// filepath: c:\xampp\htdocs\CustomCraft\admin\get_product_ratings.php
include_once "../../php/config.php";

$sql = "
SELECT 
    p.product_name,
    ROUND(AVG(r.rating), 2) AS avg_rating
FROM products p
JOIN ratings r ON p.product_id = r.product_id
GROUP BY p.product_id
ORDER BY avg_rating DESC
LIMIT 10
";
$result = $conn->query($sql);

$labels = [];
$data = [];
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['product_name'];
    $data[] = floatval($row['avg_rating']);
}
echo json_encode([
    "labels" => $labels,
    "data" => $data
]);
?>