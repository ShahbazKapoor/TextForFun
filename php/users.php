<?php
session_start();
include_once "config.php";
$senderId = $_SESSION['unique_id'];
$fetchusersQuery = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$senderId}");
$users = "";

if (mysqli_num_rows($fetchusersQuery) == 1) {
    $users .= "No users available to chat";
} elseif (mysqli_num_rows($fetchusersQuery) > 0) {
    require_once "data.php";
}
echo $users;
