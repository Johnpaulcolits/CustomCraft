<?php
session_start();
include_once "../php/config.php";

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== "user") {
  header("Location: ../login.php");
  exit();
}
if (!isset($_SESSION['unique_id'])) {
  header("location: ../login.php");
}

$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$_SESSION['unique_id']}'");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
      margin-top: 40px;
      cursor: pointer;
    }
    .form-control {
      border: none;
      border-bottom: 1px solid #ccc;
      border-radius: 0;
      box-shadow: none;
    }
    .form-control:focus {
      border-bottom: 1px solid #007bff;
      outline: none;
      box-shadow: none;
    }
    .back-button {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 10;
    }
    .back-button img {
      width: 24px;
      height: 24px;
    }
    .upload-input {
      display: none;
    }
  </style>
</head>
<body>
<form method="POST" enctype="multipart/form-data" action="./phpController/updateprofile.php">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-sm-12">
        <div class="card shadow-lg p-4 text-center position-relative">
          <a href="index.php" class="back-button">
            <img src="https://img.icons8.com/?size=100&id=98961&format=png&color=000000" alt="Back">
          </a>
        
            <div class="position-relative d-inline-block">
              <label for="imageUpload">
                <!-- <img src="../php/images/<?php echo $row['img']; ?>" id="profileImage" class="profile-img" title="Choose a new profile picture"> -->
                  <?php
$img = $row['img'];
if (filter_var($img, FILTER_VALIDATE_URL)) {
    $profileImg = $img; // Google profile image (full URL)
} else {
    $profileImg = "../php/images/" . $img; // Local image
}
?>
<img src="<?php echo $profileImg; ?>" class="profile-image" onclick="toggleMenu()" id="profileImage" title="Choose a new profile picture">
              </label>
              <input type="file" id="imageUpload" name="imageUpload" class="upload-input" accept="image/*" onchange="previewImage(event)">
            </div>
            <h3 class="mb-4">Edit Profile</h3>
            <div class="mb-3 text-start">
              <label for="firstName" class="form-label">First Name</label>
              <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $row['fname']; ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="lastName" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $row['lname']; ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="mb-3 text-start">
              <label for="email" class="form-label">Phone Number</label>
              <div style="display: flex; align-items: center;">
  <span style="padding: 8px; background: none; border: none;">+63</span>
  <input type="tel" class="form-control" name="phone" id="phone" placeholder="9XXXXXXXXX" 
         style="flex: 1; border-left: 0;" maxlength="10" pattern="9[0-9]{9}" 
         title="Please enter a valid 10-digit phone number starting with 9" 
         oninput="this.value = this.value.replace(/[^0-9]/g, '')">
</div>
            </div>
            <div class="mb-3 text-start">
              <label for="email" class="form-label">Complete Address</label>
              <input type="text" class="form-control" name="address" id="address" placeholder="Enter Your Address">
            </div>
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
       
          <div class="d-grid mb-3">
            <a href="change-password.html" class="btn btn-outline-secondary">Change Password</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  </form>

  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        const profileImage = document.getElementById('profileImage');
        profileImage.src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>
</body>
</html>
