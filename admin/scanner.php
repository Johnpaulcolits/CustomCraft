<?php
include_once "../php/config.php";

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reference'])) {
    $reference = trim($_POST['reference']);
    $scanned_at = date('Y-m-d H:i:s');

    // Check if reference exists in orders table
    $check = $conn->prepare("SELECT 1 FROM orders WHERE reference = ?");
    $check->bind_param("s", $reference);
    $check->execute();
    $check->store_result();
    $is_valid = $check->num_rows > 0;
    $check->close();

    // Check if already scanned
    $already = $conn->prepare("SELECT 1 FROM checkout WHERE reference = ?");
    $already->bind_param("s", $reference);
    $already->execute();
    $already->store_result();
    $is_already = $already->num_rows > 0;
    $already->close();

    $valid_flag = $is_valid ? 1 : 0;

    if ($is_valid && !$is_already) {
        // Insert only if not already scanned
        $stmt = $conn->prepare("INSERT INTO checkout (reference, scanned_at, is_valid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $reference, $scanned_at, $valid_flag);
        $stmt->execute();
        $stmt->close();
        $response = [
            'status' => 'success',
            'message' => "Reference <b>$reference</b> verified and saved!"
        ];
    } elseif ($is_valid && $is_already) {
        $response = [
            'status' => 'already',
            'message' => "Reference <b>$reference</b> already scanned!"
        ];
    } else {
        // Not valid, but still insert for record
        $stmt = $conn->prepare("INSERT INTO checkout (reference, scanned_at, is_valid) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $reference, $scanned_at, $valid_flag);
        $stmt->execute();
        $stmt->close();
        $response = [
            'status' => 'error',
            'message' => "Reference <b>$reference</b> not found, but saved."
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <style>
        #reader { width: 320px; margin: 30px auto; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="center mt-4">Scan Order QR Code</h2>
        <div id="msg" class="alert center" style="display:none;"></div>
        <div id="reader"></div>
        <!-- Audio feedback -->
        <audio id="successSound" src="https://cdn.pixabay.com/audio/2022/07/26/audio_124bfae5b6.mp3"></audio>
        <audio id="alreadySound" src="https://cdn.pixabay.com/audio/2022/07/26/audio_12bfae5b6.mp3"></audio>
        <audio id="errorSound" src="https://cdn.pixabay.com/audio/2022/07/26/audio_12cfae5b6.mp3"></audio>
    </div>
    <script>
        function playSound(status) {
            if(status === 'success') {
                document.getElementById('successSound').play();
            } else if(status === 'already') {
                document.getElementById('alreadySound').play();
            } else {
                document.getElementById('errorSound').play();
            }
        }
        function showMsg(msg, status) {
            var el = document.getElementById('msg');
            el.innerHTML = msg;
            el.className = 'alert center ' +
                (status === 'success' ? 'alert-success' :
                 status === 'already' ? 'alert-warning' : 'alert-danger');
            el.style.display = 'block';
        }
        function onScanSuccess(decodedText, decodedResult) {
            fetch('', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'reference=' + encodeURIComponent(decodedText)
            })
            .then(response => response.json())
            .then(data => {
                showMsg(data.message, data.status);
                playSound(data.status);
            });
            html5QrcodeScanner.clear();
            setTimeout(() => {
                document.getElementById('msg').style.display = 'none';
                window.location.reload();
            }, 2000);
        }
        function onScanFailure(error) {}
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</body>
</html>