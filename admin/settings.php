<?php
session_start();
include_once "../php/config.php";

$stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

$stmt->execute();

$users = $stmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="shortcut icon" href="assets/images/logo/icon-logo.png" type="image/x-icon" />
   <style>

   </style>
</head>
<body>

<?php while($row = $users->fetch_assoc()){  ?>
<div class="row justify-content-center mt-200">
            <div class="col-lg-6">
                <form action="">
              <div class="card-style settings-card-1 mb-30">
                <div class="title mb-30 d-flex justify-content-between align-items-center">
                  <h6>My Profile</h6>
                 <!-- <a href="update.profile.php"> <button class="border-0 bg-transparent">
                    <i class="lni lni-pencil-alt"></i>
                  </button></a> -->
                  <a href="index.php"><img src="./imgproducts/back.png" width="25px" style="margin-left: 530px">
                  <a href="update.profile.php" ><i class="lni lni-pencil-alt  edit-button"></i></a>
                </div>
                <div class="profile-info">
                  <div class="d-flex align-items-center mb-30">
                  <!-- <div class="profile-image">

    <img id="profileImg" src="../php/images/<?php echo $row['img'] ?>" alt="Profile Image" />

    <div class="update-image">
        <input type="file" id="fileInput" accept="image/*" />
        <label for="fileInput"><i class="lni lni-cloud-upload"></i></label>
    </div>
</div> -->
<div class="profile-image">
                      <img src="../php/images/<?php echo $row['img'] ?>" alt="" />
                      <!-- <div class="update-image">
                        <input type="file" />
                        <label for=""><i class="lni lni-cloud-upload"></i></label>
                      </div> -->
                    </div>
                    <div class="profile-meta">
                      <h5 class="text-bold text-dark mb-10"><?php echo $row['fname']. " ". $row['lname'] ?></h5>
                      <p class="text-sm text-gray"><?php echo $row['usertype']?></p>
                    </div>
                  </div>
                  <div class="input-style-1">
                    <label>Email</label>
                    <input type="email"  value="<?php echo $row['email'] ?>" name="email" readonly />
                  </div>
                </div>
              

              </div>

             
              <!-- end card -->
            </div>
            <!-- end col -->
            </div>
            <?php }?>
</body>
</html>

<script>
    const fileInput = document.getElementById('fileInput');
    const profileImg = document.getElementById('profileImg');

    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profileImg.src = e.target.result; // Update the image source dynamically
            };
            reader.readAsDataURL(file); // Convert file to base64 URL
        }
    });
</script>