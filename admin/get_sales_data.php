<?php

include_once "../php/config.php";

$type = isset($_GET['type']) ? $_GET['type'] : 'yearly';

$data = [];
$labels = [];

if ($type == 'monthly') {
    // Current year, group by month
    $sql = "SELECT MONTH(order_date) as period, SUM(subtotal) as revenue
            FROM orders
            WHERE YEAR(order_date) = YEAR(CURDATE())
            GROUP BY MONTH(order_date)";
    $labels = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    $data = array_fill(1, 12, 0);
} elseif ($type == 'weekly') {
    // Current month, group by week
    $sql = "SELECT WEEK(order_date, 1) as period, SUM(subtotal) as revenue
            FROM orders
            WHERE YEAR(order_date) = YEAR(CURDATE()) AND MONTH(order_date) = MONTH(CURDATE())
            GROUP BY WEEK(order_date, 1)";
    $labels = ["Week 1","Week 2","Week 3","Week 4","Week 5","Week 6"];
    $data = array_fill(1, 6, 0);
} else {
    // Yearly, start from current year and go forward as data exists
    $sql = "SELECT YEAR(order_date) as period, SUM(subtotal) as revenue
            FROM orders
            WHERE YEAR(order_date) >= YEAR(CURDATE())
            GROUP BY YEAR(order_date)
            ORDER BY period ASC";
    $result = $conn->query($sql);

    $currentYear = date('Y');
    $years = [];
    $revenues = [];

    // Collect all years and revenues from DB
    while ($row = $result->fetch_assoc()) {
        $years[] = $row['period'];
        $revenues[$row['period']] = (float)$row['revenue'];
    }

    // If no data yet, show current year
    if (empty($years)) {
        $labels[] = $currentYear;
        $data[] = 0;
    } else {
        // Fill in all years from current year to max year in DB
        $maxYear = max($years);
        for ($y = $currentYear; $y <= $maxYear; $y++) {
            $labels[] = (string)$y;
            $data[] = isset($revenues[$y]) ? $revenues[$y] : 0;
        }
    }

    echo json_encode([
        'labels' => $labels,
        'data' => $data
    ]);
    exit;
}

// For monthly/weekly
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $data[(int)$row['period']] = (float)$row['revenue'];
}

echo json_encode([
    'labels' => array_values($labels),
    'data' => array_values($data)
]);