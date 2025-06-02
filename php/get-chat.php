<?php

    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                // Prepare message and file display
                $msg = $row['msg'];
                // Check for [file:filename] pattern
               if(preg_match('/\[file:(.+?)\]/', $msg, $matches)){
    $filename = trim($matches[1]);
    if (strpos($filename, '../../../uploads/') === 0) {
        $file_url = $filename;
    } else {
        $file_url = "../../../uploads/" . $filename;
    }
    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $msg = trim(str_replace($matches[0], '', $msg));
    if(in_array($file_ext, ['jpg','jpeg','png','gif','webp'])){
        $download_name = "craft_image." . $file_ext;
        // This HTML is used for both outgoing and incoming messages
        $msg .= '<br>
            <img src="'.$file_url.'" alt="'.$filename.'" style="width:100%;max-width:400px;height:auto;border-radius:8px;">
            <br>
            <a href="'.$file_url.'" download="'.$download_name.'" style="font-size:12px;">Download image</a>';
    } else {
        $msg .= '<br><a href="'.$file_url.'" target="_blank" download="'.$filename.'">'.$filename.'</a>';
    }
                }

                if($row['outgoing_msg_id'] == $outgoing_id){
                    $output .= '<div class="chat outgoing">
                        <div class="details">
                            <p>'. $msg .'</p>
                        </div>
                        </div>';
                }else{
                    // Determine if $row['img'] is a URL or a local file
                    $img = $row['img'];
                    if (filter_var($img, FILTER_VALIDATE_URL)) {
                        $profileImg = $img; // Google profile image (full URL)
                    } else {
                        $profileImg = "php/images/" . $img; // Local image
                    }

                    $output .= '<div class="chat incoming">
                        <img src="' . $profileImg . '" alt="">
                        <div class="details">
                            <p>' . $msg . '</p>
                        </div>
                        </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }
?>