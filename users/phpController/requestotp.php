<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "../../vendor/autoload.php";
require_once "../../php/config.php";

if (isset($_POST['request_otp'])) {
    $email = $_POST['email'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email' LIMIT 1");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['user_id'];

        $otp = rand(100000, 999999);
        $otp_expiration = date('Y-m-d H:i:s', strtotime('+5 minute'));

        $conn->query("UPDATE users SET otp='$otp', otp_expiration='$otp_expiration' WHERE user_id='$user_id'");

        $_SESSION['user_id'] = $user_id;
        $_SESSION['otp_sent'] = true;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jagsportsapparelshop@gmail.com';
            $mail->Password = 'eljsxbobsrnpsiwv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('jagsportsapparelshop@gmail.com', 'RESET PASSWORD');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
$mail->Body = "Hello,<br><br>You requested a password reset. Use the following One-Time Password (OTP) to proceed:<br><br>
<b>$otp</b><br><br>This OTP will expire in 5 minutes. If you did not request this reset, please ignore this message.<br><br>Thank you,<br>From: CustomCraft";


            $mail->send();
            echo 'success';
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Email not found!';
    }
}
?>