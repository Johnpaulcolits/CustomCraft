<?php

include_once "../php/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Only allow "Approved" or "Declined" as valid status values
    $valid_statuses = ['Approved', 'Declined'];

    // If updating by unique_id and order_date (group action)
    if (isset($_POST['unique_id'], $_POST['order_date'], $_POST['status'])) {
        $unique_id = $_POST['unique_id'];
        $order_date = $_POST['order_date'];
        $status = $_POST['status'];

        if (in_array($status, $valid_statuses)) {
            $stmt = $conn->prepare("UPDATE orders SET status=? WHERE unique_id=? AND order_date=?");
            $stmt->bind_param("sss", $status, $unique_id, $order_date);
            if ($stmt->execute()) {
                echo "<script>alert('Order status updated for the whole group.'); window.location.href='orders.php'</script>";
            } else {
                echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Invalid status.'); window.location.href='orders.php'</script>";
        }
    }
    // If updating by order_id (single row action)
    elseif (isset($_POST['order_id'], $_POST['status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        if (in_array($status, $valid_statuses)) {
            $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
            $stmt->bind_param('si', $status, $order_id);
            if ($stmt->execute()) {
                echo "<script>alert('Order status updated successfully.'); window.location.href='orders.php'</script>";
            } else {
                echo "<script>alert('Error updating status: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Invalid status.'); window.location.href='orders.php'</script>";
        }
    }

    $conn->close();
}
?>