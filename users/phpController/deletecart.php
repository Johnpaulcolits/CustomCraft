<?php


include '../../php/config.php'; // Ensure you have a database connection file

header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cart_id'])) {
    $cart_id = $data['cart_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->bind_param("i", $cart_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Cart item deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error deleting cart item"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request"]);
}
?>




