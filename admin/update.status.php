<?php
include_once "../php/config.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update query
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $status, $order_id);
        if ($stmt->execute()) {
            echo "<script>alert('Order status updated successfully.'); window.location.href='orders.php'</script>";
        } else {
            echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }

    $conn->close();
}




?>