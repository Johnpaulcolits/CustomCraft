<?php
include_once "../../php/config.php";
session_start();

$user_id = $_SESSION['unique_id'];

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Fetch current image
    $query = mysqli_query($conn, "SELECT img FROM users WHERE unique_id = '$user_id'");
    $row = mysqli_fetch_assoc($query);
    $current_image = $row['img'];

    // Handle image upload
    if (!empty($_FILES["profile_pic"]["name"])) {
        $target_dir = "../php/images/";
        $image_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                // Delete old image
                if (!empty($current_image) && file_exists($target_dir . $current_image)) {
                    unlink($target_dir . $current_image);
                }
                // Update database with new image
                $sql = "UPDATE users SET fname = '$fname', lname = '$lname', email = '$email', img = '$image_name' WHERE unique_id = '$user_id'";
            } else {
                $response = [
                    "status" => "error",
                    "message" => "Error uploading image."
                ];
                echo json_encode($response);
                exit();
            }
        } else {
            $response = [
                "status" => "error",
                "message" => "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed."
            ];
            echo json_encode($response);
            exit();
        }
    } else {
        // Update profile without changing image
        $sql = "UPDATE users SET fname = '$fname', lname = '$lname', email = '$email' WHERE unique_id = '$user_id'";
    }

    if (mysqli_query($conn, $sql)) {
        $response = [
            "status" => "success",
            "message" => "Profile updated successfully!"
        ];
    } else {
        $response = [
            "status" => "error",
            "message" => "Error updating record: " . mysqli_error($conn)
        ];
    }

    mysqli_close($conn);
}

echo json_encode($response);
?>

<php
?>