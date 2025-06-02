<?php 
session_start();

if (isset($_SESSION['usertype'])) {
    if ($_SESSION['usertype'] == "admin") {
        header("location: ./admin/index.php"); // Redirect admin
        exit();
    } elseif ($_SESSION['usertype'] == "moderator") {
        header("Location: moderator_dashboard.php"); // Redirect moderator
        exit();
    } else {
        header("location: ./users/index.php"); // Redirect regular user
        exit();
    }
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
  <style>
    /* Center the Google Sign-In container and button */
.g-signin-center {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CustomCraft Login</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link rel="shortcut icon" href="./admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Login</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Login">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
      <div class="link">Forgot Password? <a href="otpsent.php">Reset it now</a></div>
      <div style="text-align:center; margin-bottom: 16px;">
  <div id="g_id_onload"
       data-client_id="296791958684-qj9s5b7qu9lsps2vvf0g8elg5s70epof.apps.googleusercontent.com"
       data-context="signup"
       data-ux_mode="popup"
       data-callback="handleGoogleSignIn"
       data-auto_prompt="false">
  </div>
  <div class="g_id_signin"
       data-type="standard"
       data-shape="rectangular"
       data-theme="outline"
       data-text="continue_with"
       data-size="large"
       data-logo_alignment="left">
  </div>
</div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>
  <script src="javascript/google.js"></script>

</body>
</html>
