<?php
session_start();
if (!isset($_SESSION['AdminID'])) {
    header("Location: /pawtrack/frontend/admin/admin-login.php");
    exit();
}
$id = $_SESSION['AdminID'];
$fname = $_SESSION['AdminFName'];
$sname = $_SESSION['AdminSName'];
$email = $_SESSION['AdminEmail'];
$hashedPassword = $_SESSION['AdminPassword'];
$log = $_SESSION['AdminLog'];
$startDate = $_SESSION['AdminStartDate'];
$pic = $_SESSION['AdminPic'];
?>