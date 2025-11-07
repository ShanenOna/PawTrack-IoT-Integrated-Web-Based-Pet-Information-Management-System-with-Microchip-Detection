<?php
// Use a correct absolute path to include backend files safely and only once
require_once __DIR__ . '/../../backend/fetch-class.php';
// Only start session if not already active to avoid notices
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['ClientID'])) {
    header("Location: /");
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