<?php

include_once "../../php/config.php";
$counts = [1=>0,2=>0,3=>0,4=>0,5=>0];
$sql = "SELECT rating, COUNT(*) as cnt FROM ratings GROUP BY rating";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $counts[$row['rating']] = (int)$row['cnt'];
}
echo json_encode($counts);
?>