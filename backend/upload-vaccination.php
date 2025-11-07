<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/vet-class.php';

$vet = new Vet($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petID = $_POST['PetID'] ?? null;
    $clientID = $_POST['ClientID'] ?? null;
    $shotType = $_POST['ShotType'] ?? null;
    $date = $_POST['Date'] ?? null;
    $nextDue = $_POST['NextDueDate'] ?? null;
    $veterinarian = $_POST['Veterinarian'] ?? null;
    $clinic = $_POST['Clinic'] ?? null;

    if (!$petID || !$clientID || !$shotType || !$date) {
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields.']);
        exit;
    }

    $result = $vet->addVaccinationRecord($petID, $clientID, $shotType, $date, $nextDue, $veterinarian, $clinic);
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
