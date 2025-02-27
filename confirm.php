<?php
session_start();
include_once "./php/config.php";


if (!isset($_SESSION['confirm_otp'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['unique_id'];
$result = $conn->query("SELECT confirm_otp, confirm_otp_expiration FROM users WHERE unique_id='$user_id' LIMIT 1");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (strtotime($user['confirm_otp_expiration']) < time()) {
        if (!is_null($user['confirm_otp'])) { // Only delete if confirm_otp is not null
            $conn->query("DELETE FROM users WHERE unique_id = '{$user_id}'");
            session_destroy();
            unset($_SESSION['confirm_otp']);
            unset($_SESSION['unique_id']);
        }

        // Show the OTP expiration message
        echo "<div style='padding: 10px; background-color: #ffcccc; color: #cc0000; border: 1px solid #cc0000; border-radius: 5px; text-align: center; margin-bottom: 10px;'>
        OTP expired, please request a new one
      </div>";

        // Delay the redirect so the user sees the message
        echo "<script>
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1500); // 1.5-second delay so message stays visible
        </script>";
        exit();
    }
}

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm OTP</title>
      <link rel="shortcut icon" href="./admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
      <link rel="stylesheet" href="style.css">
   
</head>
<body>

<div class="wrapper">
    <section class="form signup">
    <header>Confirm OTP</header>
    <form method="POST" class="otp-form">
        <h2>Enter OTP</h2>
        <div class="field input">
        <input type="text" name="otp" placeholder="Enter your OTP" required>
        </div>
        <div class="field button">
        <!-- <button type="submit">Confirm OTP</button> -->
        <input type="submit"  value="Confirm OTP">
        </div>
    </form>
    </section>
</div>







</body>
</html>

<script>
    document.querySelector('.otp-form').addEventListener('submit', async function(e) {
    e.preventDefault(); // Prevent the default form submission

    const otpInput = document.querySelector('input[name="otp"]').value;

    if (otpInput.trim() === '') {
        alert('Please enter the OTP!');
        return;
    }

    try {
        const response = await fetch('./users/phpController/confirmotp.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ otp: otpInput })
        });

        const result = await response.text();
        alert(result); // Show the response from the PHP script

        if (result.includes('success')) {
            window.location.href = '../../users/index.php';
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    }
});

</script>