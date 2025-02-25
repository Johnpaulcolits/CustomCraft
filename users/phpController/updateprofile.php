<?php
session_start();
include_once "../../php/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $userId = $_SESSION['unique_id']; // Assuming user_id is stored in session

    $image = $_FILES['imageUpload'];
    $imageName = '';

    if ($image['name']) {
        $targetDir = '../../php/images/';
        $imageName = basename($image['name']);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate image
        $check = getimagesize($image['tmp_name']);
        if ($check === false) {
            echo "<script>alert('File is not an image.');</script>";
            exit;
        }

        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            // Update with image
            $query = "UPDATE users SET fname='$firstName', lname='$lastName', email='$email', phone_number='$phone', address='$address', img='$imageName' WHERE unique_id='$userId'";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            exit;
        }
    } else {
        // Update without changing image
        $query = "UPDATE users SET fname='$firstName', lname='$lastName', email='$email', phone_number='$phone', address='$address' WHERE unique_id='$userId'";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='../settings.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>