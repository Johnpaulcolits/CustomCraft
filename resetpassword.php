<?php
include_once "./php/config.php";
session_start();
// reset_password.php
if (!isset($_SESSION['otp_verified'])) {
    header('Location: verifyotp.php');
    exit();
}

// Check if OTP is expired from the database
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
    <title>Change Password</title>
    <link rel="shortcut icon" href="./admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">
    <section class="form signup">
    <header>Reset Password</header>
    <form id="resetForm">
    <div class="field input">
        <input type="password" name="password" id="password" placeholder="New Password" required>
    </div>
    <div class="field button">
        <!-- <button type="submit" name="reset_password">Reset Password</button> -->
         <input type="submit" name="reset_password" value="Reset Password">
    </div>
    </form>
    </section>
</div>

</body>
</html>

<script>
   document.getElementById("resetForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData();
    formData.append("reset_password", true);
    formData.append("password", document.getElementById("password").value);

    fetch("./users/phpController/resetpass.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // Parse the response as text
    .then(data => {
        // Always show the success message, regardless of response
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "success",
            title: "Password updated successfully!",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        }).then(() => {
            // Redirect after success message
            window.location.href = "otpsent.php";
        });
    })
    .catch(error => {
        console.error("Error:", error);
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "error",
            title: "Something went wrong! Please try again.",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
    });
});
</script>