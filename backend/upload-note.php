<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/vet-class.php';

$vet = new Vet($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petID = $_POST['PetID'] ?? null;
    $clientID = $_POST['ClientID'] ?? null;
    $date = $_POST['Date'] ?? date('Y-m-d');
    $veterinarian = $_POST['Veterinarian'] ?? null;
    $clinic = $_POST['Clinic'] ?? null;
    $visitType = $_POST['VisitType'] ?? null;
    $notes = $_POST['Notes'] ?? null;
    // Accept either 'FollowUp' (frontend form) or 'FollowUpRecommendation' (backwards compatibility)
    $followUp = $_POST['FollowUp'] ?? $_POST['FollowUpRecommendation'] ?? null;

    if (!$petID || !$clientID || !$veterinarian || !$clinic || !$visitType) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        exit;
    }

    $result = $vet->addNote($petID, $clientID, $date, $veterinarian, $clinic, $visitType, $notes, $followUp);
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
