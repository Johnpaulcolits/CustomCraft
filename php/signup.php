<?php
session_start();
include_once "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($confirm_password)) {
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }
    if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*()-_=+]).{8,}$/', $password)) {
        echo "Password must be at least 8 characters long, contain at least one uppercase letter, and one special character.";
        exit();
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exists!";
        } else {
            $new_img_name = "avatar.png"; // Default image

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if (in_array($img_ext, $extensions) === true) {
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if (in_array($img_type, $types) === true) {
                        $time = time();
                        $new_img_name = $time.$img_name;
                        move_uploaded_file($tmp_name, "images/".$new_img_name);
                    } else {
                        echo "Please upload an image file - jpeg, png, jpg";
                        exit();
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                    exit();
                }
            }

            $ran_id = rand(time(), 100000000);
            $status = "Active now";
            $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);

            try {
                $mail = new PHPMailer(true);
                $confirm_otp = rand(100000, 999999);
                $confirm_otp_expiration = date('Y-m-d H:i:s', strtotime('+5 minutes'));

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jagsportsapparelshop@gmail.com';
                $mail->Password = 'eljsxbobsrnpsiwv';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('jagsportsapparelshop@gmail.com', 'CustomCraft');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Welcome to CustomCraft - Confirm Your Registration';
                $mail->Body = "Dear Valued User,<br><br>
Thank you for registering with CustomCraft! We’re excited to have you on board.<br><br>
To complete your registration and verify your account, please use the following One-Time Password (OTP): <b>$confirm_otp</b><br><br>
This OTP is valid for 5 minutes. If you did not initiate this registration, please disregard this message.<br><br>
If you have any questions or need assistance, feel free to reach out to our support team.<br><br>
Best regards,<br>
The CustomCraft Team";

                $mail->send();

                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, confirm_otp, confirm_otp_expiration)
                VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}', '$confirm_otp', '$confirm_otp_expiration')");

                if ($insert_query) {
                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                    if (mysqli_num_rows($select_sql2) > 0) {
                        $result = mysqli_fetch_assoc($select_sql2);
                        $_SESSION['unique_id'] = $result['unique_id'];
                        $_SESSION['confirm_otp'] = true;
                        echo "success";
                    }
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } catch (Exception $e) {
                echo "Try to Check Your Connection";
                exit(); // Stop execution and prevent data insertion
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
?>
