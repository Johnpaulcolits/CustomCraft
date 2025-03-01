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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">  
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CustomCraft - Signup </title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link rel="shortcut icon" href="./admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
</head>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Signup</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field input">
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" placeholder="Confirm your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <!-- <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required >
        </div> -->
        <div class="field button">
          <input type="submit" name="submit" value="Sign up">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>    

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>
</body>
</html>

