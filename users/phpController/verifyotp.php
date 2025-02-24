<?php
include "../../php/config.php";
session_start();

if (isset($_POST['verify_otp'])) {
    $user_otp = $_POST['otp'];
    $user_id = $_SESSION['user_id'];

    $result = $conn->query("SELECT otp, otp_expiration FROM users WHERE user_id='$user_id'");
    $row = $result->fetch_assoc();

    if ($row && $user_otp == $row['otp'] && strtotime($row['otp_expiration']) > time()) {
        $_SESSION['otp_verified'] = true;
        echo 'OTP verified!';
    } else {
        echo 'Invalid OTP!';
    }
}


?>