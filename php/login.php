<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) { // check email and password exist in database or not
    $checkLoginDetailsQuery = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
    if (mysqli_num_rows($checkLoginDetailsQuery) > 0) { // if exist this provide login to user
        $row = mysqli_fetch_assoc($checkLoginDetailsQuery);
        $status = "Active now";
        $updateStatusSql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
        if ($updateStatusSql) {
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
        }
    } else {
        echo "Incorrect email or password";
    }
} else {
    echo "All input fields are required!";
}
