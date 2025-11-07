<?php
header('Content-Type: application/json');
include_once(__DIR__ . '/db.php');
include_once(__DIR__ . '/vet-class.php');

$vet = new Vet($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petID = $_POST['PetID'] ?? null;

    if (!$petID) {
        echo json_encode(['status' => 'error', 'message' => 'Missing PetID.']);
        exit;
    }

    $result = $vet->getMedicalRecords($petID);
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
