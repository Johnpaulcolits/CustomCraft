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
.submit-button {
    background-color: #007bff; /* Bootstrap primary blue */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

.submit-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: scale(1.05);
}

.submit-button:active {
    transform: scale(0.98);
}


   </style>
</head>
<body>

<?php while($row = $users->fetch_assoc()){  ?>
<div class="row justify-content-center mt-50">
            <div class="col-lg-6">
            <form  method="POST" enctype="multipart/form-data">
    <div class="card-style settings-card-1 mb-30">
        <div class="title mb-30 d-flex justify-content-between align-items-center">
            <h6>Update Profile</h6>
            <a href="view.profile.php"><img src="./imgproducts/back.png" width="30px">
            </a>
        </div>
        <div class="profile-info">
            <div class="d-flex align-items-center mb-30">
                <div class="profile-image">
                    <img id="profileImg" src="../php/images/<?php echo htmlspecialchars($row['img']); ?>" alt="Profile Image" />
                    <div class="update-image">
                        <input type="file" id="fileInput" name="profile_pic" accept="image/*" />
                        <label for="fileInput"><i class="lni lni-cloud-upload"></i></label>
                    </div>
                </div>
            </div>

            <div class="input-style-1">
                <label>First Name</label>
                <input type="text" value="<?php echo htmlspecialchars($row['fname']); ?>" name="fname" required />
            </div>
            <div class="input-style-1">
                <label>Last Name</label>
                <input type="text" value="<?php echo htmlspecialchars($row['lname']); ?>" name="lname" required />
            </div>
            <div class="input-style-1">
                <label>Email</label>
                <input type="email" value="<?php echo htmlspecialchars($row['email']); ?>" name="email" required />
            </div>
        </div>

        <input type="submit" value="Update Profile" class="submit-button">
    </div>
</form>

             
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
                profileImg.src = e.target.result; // Preview the image before uploading
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['unique_id']; // Assuming user is logged in
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $img_name = "";

    // Handle Image Upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "../php/images/";
        $img_name = basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $img_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                // Image uploaded successfully
            } else {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG & GIF are allowed.";
            exit();
        }
    } else {
        // Keep the old image if no new file is uploaded
        $sql = "SELECT img FROM users WHERE unique_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $img_name = $row['img']; // Keep the existing image
        }
    }

    // Update user details in the database
    $sql = "UPDATE users SET fname=?, lname=?, email=?, img=? WHERE unique_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $fname, $lname, $email, $img_name, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='update.profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile.'); window.location.href='update.profile.php';</script>";
    }
}

?>


