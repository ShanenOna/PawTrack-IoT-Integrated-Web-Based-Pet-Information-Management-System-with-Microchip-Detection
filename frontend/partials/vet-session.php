<?php
session_start();
if (!isset($_SESSION['VetID'])) {
    header("Location: /pawtrack/frontend/vet/vet-login.php");
    exit();
}
$adminID = $_SESSION['AdminID'];
$id = $_SESSION['VetID'];
$fname = $_SESSION['VetFName'];
$sname = $_SESSION['VetSName'];
$email = $_SESSION['VetEmail'];
$hashedPassword = $_SESSION['VetPassword'];
$log = $_SESSION['VetLog'];
$startDate = $_SESSION['VetStartDate'];
$pic = $_SESSION['VetPic'];
?>