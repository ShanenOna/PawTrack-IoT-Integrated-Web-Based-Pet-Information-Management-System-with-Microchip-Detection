<?php
include($_SERVER['DOCUMENT_ROOT'] . "/pawtrack/backend/fetch-class.php");
session_start();
if (!isset($_SESSION['ClientID'])) {
    header("Location: /pawtrack/frontend/login.php");
    exit();
}
$id = $_SESSION['ClientID'];
$fname = $_SESSION['ClientFName'];
$lname = $_SESSION['ClientLName'];
$email = $_SESSION['ClientEmail'];
$hashedPassword = $_SESSION['ClientPassword'];
$log = $_SESSION['ClientLog'];
$startDate = $_SESSION['ClientStartDate'];
$pic = $_SESSION['ClientPic'];

$fetch = new fetchClass();
$pets = $fetch->getClientPets($id);
?>