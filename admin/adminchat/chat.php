<?php 
  session_start();
  include_once "../../php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: ../../../craft.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                   <?php
// After fetching $row from the database:
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../../../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" onclick="toggleMenu()" id="profile">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <!-- <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form> -->
      <form action="#" class="typing-area" enctype="multipart/form-data" autocomplete="off">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
         <button type="submit"><i class="fab fa-telegram-plane"></i></button>
        <label for="file-input" style="cursor: pointer; margin-left: 10px;" >
          <i class="fas fa-file" style="font-size: 45px; color:gray;"></i>
        </label>
        <input type="file" name="file-input" id="file-input" style="display: none; " multiple>
       
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
