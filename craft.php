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
        header("location: users.php"); // Redirect regular user
        exit();
    }
}
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>Realtime Chat App</header>
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
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="admin.login.js"></script>

</body>
</html>
