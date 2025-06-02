<?php


session_start();
include_once "php/config.php";

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);
$token = $data['credential'] ?? '';

if (!$token) {
    echo json_encode(['success' => false, 'message' => 'No token provided']);
    exit;
}

// Verify token with Google
//localhost
$client_id = "296791958684-qj9s5b7qu9lsps2vvf0g8elg5s70epof.apps.googleusercontent.com";
// Live server
// $client_id = "29493722479-hso2iovdrvq601nsri0p7p2gh7am4047.apps.googleusercontent.com";
$google_api_url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token;
$google_response = file_get_contents($google_api_url);
$userinfo = json_decode($google_response, true);

if (!$userinfo || !isset($userinfo['email'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid Google token']);
    exit;
}

// Prepare user data
$email = $userinfo['email'];
$fname = $userinfo['given_name'] ?? '';
$lname = $userinfo['family_name'] ?? '';
$google_id = $userinfo['sub'];
$profile_img = $userinfo['picture'] ?? null; // Optional: Google profile picture

// Check if user already exists
$stmt = $conn->prepare("SELECT unique_id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Insert new user
     $status = "Active now";
    $ran_id = rand(time(), 100000000);
    $usertype = 'user';

    // If you have a profile_img column, use this query:
    $stmt = $conn->prepare("INSERT INTO users (unique_id, fname, lname, email, google_id, img, usertype, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $ran_id, $fname, $lname, $email, $google_id, $profile_img, $usertype, $status);

    // If you do NOT have a profile_img column, use this query:
    // $stmt = $conn->prepare("INSERT INTO users (unique_id, fname, lname, email, google_id, usertype) VALUES (?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("isssss", $ran_id, $fname, $lname, $email, $google_id, $usertype);

    $stmt->execute();
    $_SESSION['unique_id'] = $ran_id;
} else {
    // User exists, get their unique_id
    $row = $result->fetch_assoc();
    $_SESSION['unique_id'] = $row['unique_id'];
    
       $status = "Active now";
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE unique_id = ?");
    $stmt->bind_param("si", $status, $row['unique_id']);
    $stmt->execute();
}

// Set session and login
$_SESSION['usertype'] = 'user';
$_SESSION['email'] = $email;

echo json_encode(['success' => true]);