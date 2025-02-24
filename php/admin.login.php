<?php 
session_start();
include_once "config.php";

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        // $user_pass = md5($password);
        // $enc_pass = $row['password'];
        $enc_pass = $row['password'];

        if (password_verify($password, $enc_pass)) {
            if ($row['usertype'] == "admin") { // Only allow admins
                $status = "Active now";
                $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                if ($sql2) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    $_SESSION['usertype'] = $row['usertype']; // Store usertype in session
                    echo "admin"; // Send response for admin login
                } else {
                    echo "Something went wrong. Please try again!";
                }
            } else {
                echo "Access Denied! Only Admins can log in."; // Restrict users & moderators
            }
        } else {
            echo "Email or Password is Incorrect!";
        }
    } else {
        echo "$email - This email does not exist!";
    }
} else {
    echo "All input fields are required!";
}
?>
