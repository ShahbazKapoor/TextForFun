<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    require_once "config.php";
    $senderId = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $receiverId = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message)) {
        $insertmessageQuery = mysqli_query($conn, "INSERT INTO messages (receiver_msg_id, sender_msg_id, msg)
                                            values ({$senderId}, {$receiverId}, '{$message}')") or die();
    }
} else {
    header("../login.php");
}
