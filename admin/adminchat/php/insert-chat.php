<?php 
    // session_start();
    // if(isset($_SESSION['unique_id'])){
    //     include_once "../../../php/config.php";
    //     $outgoing_id = $_SESSION['unique_id'];
    //     $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    //     $message = mysqli_real_escape_string($conn, $_POST['message']);
    //     if(!empty($message)){
    //         $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
    //                                     VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
    //     }
    // }else{
    //     header("location: ../login.php");
    // }


    
?>

<?php

session_start();
if(isset($_SESSION['unique_id'])){
    include_once "../../../php/config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $msg_content = $message;

    // Handle file upload if present
    if(isset($_FILES['file-input']) && $_FILES['file-input']['error'] == 0){
        $target_dir = "../../../uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $original_name = basename($_FILES["file-input"]["name"]);
        $file_ext = pathinfo($original_name, PATHINFO_EXTENSION);
        $target_file = $target_dir . $original_name;
        $counter = 1;
        while(file_exists($target_file)){
            $file_name_only = pathinfo($original_name, PATHINFO_FILENAME);
            $target_file = $target_dir . $file_name_only . "($counter)." . $file_ext;
            $counter++;
        }
        $display_name = basename($target_file);

        if(move_uploaded_file($_FILES["file-input"]["tmp_name"], $target_file)){
            // Store only the file name in the message
            if(!empty($msg_content)){
                $msg_content .= " [file:" . $display_name . "]";
            } else {
                $msg_content = "[file:" . $display_name . "]";
            }
        }
    }

    // Insert message (with file info if any)
    if(!empty($msg_content)){
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                    VALUES ({$incoming_id}, {$outgoing_id}, '{$msg_content}')") or die(mysqli_error($conn));
    }
}else{
    header("location: ../../login.php");
}
?>