<?php
include_once "./php/config.php";
session_start();

if (!isset($_SESSION['otp_sent'])) {
    header('Location: otpsent.php');
    exit();
}



$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT otp_expiration FROM users WHERE user_id='$user_id' LIMIT 1");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (strtotime($user['otp_expiration']) < time()) {
        unset($_SESSION['otp_sent']);
        unset($_SESSION['user_id']);
        echo "<div style='padding: 10px; background-color: #ffcccc; color: #cc0000; border: 1px solid #cc0000; border-radius: 5px; text-align: center; margin-bottom: 10px;'>
        OTP expired, please request a new one
      </div>";
        echo "<script>
            setTimeout(() => {
                window.location.href = 'otpsent.php';
            }, 1500);
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
    <title>Verify OTP</title>
    <link rel="shortcut icon" href="./admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="wrapper">
    
    <section class="form signup">
    <header>Verify OTP</header>
    <form id="otpForm" onsubmit="event.preventDefault(); verifyOTP();">
    <div class="field input">
        <input type="text" id="otp" name="otp" placeholder="Enter OTP" required>
    </div>

        <div class="field button">
        <!-- <button type="submit" name="verify_otp" id="verifyButton">Verify OTP</button> -->
         <input type="submit" name="verify_otp" id="verifyButton" value="Verify">
        </div>
    </form>
    </section>
</div>
    
  

    <script>
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    async function verifyOTP() {
        const otp = document.getElementById('otp').value;
        const verifyButton = document.getElementById('verifyButton');

        if (!otp) {
            Toast.fire({
                icon: 'error',
                title: 'Please enter OTP'
            });
            return;
        }

        verifyButton.disabled = true;
        verifyButton.textContent = 'Verifying...';

        try {
            const response = await fetch('./users/phpController/verifyotp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'verify_otp': true,
                    'otp': otp
                })
            });

            const result = await response.text();

            if (result === 'OTP verified!') {
                Toast.fire({
                    icon: 'success',
                    title: 'OTP verified successfully'
                });
                setTimeout(() => {
                    window.location.href = 'resetpassword.php';
                }, 1500);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: result
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Toast.fire({
                icon: 'error',
                title: 'Something went wrong. Please try again later.'
            });
        } finally {
            verifyButton.disabled = false;
            verifyButton.textContent = 'Verify OTP';
        }
    }
</script>
</body>
</html>
