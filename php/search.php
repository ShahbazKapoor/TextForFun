<?php
session_start();
include_once "config.php";
$senderId = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$users = "";
$fetchusersQuery = mysqli_query($conn, "SELECT * FROM users WHERE NOT unique_id = {$senderId} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%')");
if (mysqli_num_rows($fetchusersQuery)) {
    include_once "data.php";
} else {
    $users .= "No user found.";
}
echo $users;
