<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); 

require_once __DIR__ . '/fetch-class.php'; 
session_start(); 

try {
    $fetch = new fetchClass();

    // Option 1: Get vetID from session
    if (isset($_SESSION['VetID'])) {
        $vetID = $_SESSION['VetID'];
    } 
    // Option 2: Fallback to GET/POST
    elseif (isset($_GET['vetID'])) {
        $vetID = $_GET['vetID'];
    } elseif (isset($_POST['vetID'])) {
        $vetID = $_POST['vetID'];
    } else {
        echo json_encode(["status" => "error", "message" => "Vet ID not provided"]);
        exit;
    }

    $vetData = $fetch->getPetVeterinary($vetID);

    if ($vetData) {
        echo json_encode(["status" => "success", "vet" => $vetData]);
    } else {
        echo json_encode(["status" => "error", "message" => "No vet found"]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
