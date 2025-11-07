<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/vet-class.php';

$vet = new Vet($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petID = $_POST['PetID'] ?? null;
    $clientID = $_POST['ClientID'] ?? null;
    $diagnosis = $_POST['Diagnosis'] ?? null;
    $dateDiagnosed = $_POST['DateDiagnosed'] ?? null;
    $treatment = $_POST['Treatment'] ?? null;
    $notes = $_POST['Notes'] ?? null;

    if (!$petID || !$clientID || !$diagnosis || !$dateDiagnosed) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        exit;
    }

    $result = $vet->addMedicalRecord($petID, $clientID, $diagnosis, $dateDiagnosed, $treatment, $notes);
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
