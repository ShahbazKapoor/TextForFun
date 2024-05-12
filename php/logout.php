<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $logoutId = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if (isset($logoutId)) {
        $status = "Offline now";
        $updateStatusSql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$logoutId}");
        if ($updateStatusSql) {
            session_unset();
            session_destroy();
            header("location: ../login.php");
        } else {
            header("location: ../users.php");
        }
    }
} else {
    header("location: ../login.php");
}
