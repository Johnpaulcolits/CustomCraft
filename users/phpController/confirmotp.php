<?php

include_once "../../php/config.php";
session_start();
$user_id = $_SESSION['unique_id'];
    $entered_otp = mysqli_real_escape_string($conn, $_POST['otp']);
    
    if (!empty($entered_otp)) {
        $query = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$user_id}'");
    
        if (mysqli_num_rows($query) > 0) {
            $user = mysqli_fetch_assoc($query);
    
            if ($user['confirm_otp_expiration'] <= date('Y-m-d H:i:s')) {
                $conn->query("DELETE FROM users WHERE unique_id = '{$user_id}'");
                session_destroy();
                echo "OTP expired. Your account has been deleted. Please register again.";
                exit();
            }
    
            if ($user['confirm_otp'] == $entered_otp) {
                $conn->query("UPDATE users SET confirm_otp = NULL, confirm_otp_expiration = NULL WHERE unique_id = '{$user_id}'");
                $_SESSION['unique_id'] = $user['unique_id'];
                echo "success";
            } else {
                echo "Invalid OTP!";
            }
        } else {
            echo "User not found!";
        }
    } else {
        echo "Please enter the OTP!";
    }


?>