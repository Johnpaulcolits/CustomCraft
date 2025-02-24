<?php
session_start();
include "../../php/config.php";

if (isset($_POST['reset_password'])) {
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_id = $_SESSION['user_id'] ?? null;

    if ($user_id) {
        $stmt = $conn->prepare("UPDATE users SET password=?, otp=NULL, otp_expiration=NULL WHERE user_id=?");
        $stmt->bind_param("si", $new_password, $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo 'Password updated successfully!';
        } else {
            echo 'No changes made or user not found.';
        }

        $stmt->close();
        flush(); // Ensure output is sent before session destruction
        session_destroy();
    }
}
?>
