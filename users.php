<?php 
// session_start();

// if (isset($_SESSION['usertype'])) {
//     if ($_SESSION['usertype'] == "admin") {
//         header("Location: login.php"); // Redirect admin
//         exit();
//     } elseif ($_SESSION['usertype'] == "moderator") {
//         header("Location: moderator_dashboard.php"); // Redirect moderator
//         exit();
//     } else {
//         header("Location: login.php"); // Redirect regular user
//         exit();
//     }
// }

  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }


?>

<?php
include_once "php/config.php";
include_once "header.php";
?>
<body>

  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          
          <?php
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" >
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="./users/index.php" class="logout">Back</a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
  
</body>
</html>

