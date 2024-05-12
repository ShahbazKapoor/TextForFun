<?php
while ($row = mysqli_fetch_assoc($fetchusersQuery)) {
    $sql2 = "SELECT * FROM messages WHERE (receiver_msg_id = {$row['unique_id']}
            OR sender_msg_id = {$row['unique_id']}) AND (sender_msg_id = {$senderId}
            OR receiver_msg_id = {$senderId}) ORDER BY id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if (mysqli_num_rows($query2) > 0) {
        $result = $row2['msg'];
    } else {
        $result = "No message available";
    }

    (strlen($result) > 25) ? $msg = substr($result, 0, 25) . '...' : $msg = $result; // message trimming
    $you = ""; // Default value
    if ($row2 !== null && array_key_exists('receiver_msg_id', $row2) && $senderId == $row2['receiver_msg_id']) {
        $you = "You: ";
    }

    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

    $users .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src="images/' . $row['img'] . '" alt="No Img Found" />
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
                </a>';
}
