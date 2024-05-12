<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    require_once "config.php";
    $senderId = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $receiverId = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = "";

    $fetchMsgSql = "SELECT * FROM messages
                    LEFT JOIN users ON users.unique_id = messages.sender_msg_id
                    WHERE (receiver_msg_id = {$senderId} AND sender_msg_id = {$receiverId})
                        OR (receiver_msg_id = {$receiverId} AND sender_msg_id = {$senderId}) ORDER BY messages.id";
    $fetchMsgQuery = mysqli_query($conn, $fetchMsgSql);
    if (mysqli_num_rows($fetchMsgQuery)) {
        while ($row = mysqli_fetch_assoc($fetchMsgQuery)) {
            if ($row['receiver_msg_id'] === $senderId) {
                $message .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            } else {
                $message .= '<div class="chat incoming">
                                <img src="images/'. $row['img'] .'" alt="No Img Found">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            }
        }
        // var_dump($message);
        echo $message;
    }
} else {
    header("../login.php");
}
