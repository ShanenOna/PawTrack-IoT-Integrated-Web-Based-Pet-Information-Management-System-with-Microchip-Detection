<?php
header("Content-Type: application/json");
require_once __DIR__ . '/fetch-class.php';

try {
    $fetch = new fetchClass();

    // Only allow search via PetChipNum (supports GET or POST)
    $petChipNum = $_GET['PetChipNum'] ?? $_POST['PetChipNum'] ?? null;

    if (!$petChipNum) {
        echo json_encode([ "status" => "error", "message" => "Please provide PetChipNum." ]);
        exit;
    }

    // Fetch Pet Details by Microchip Number
    $petDetails = $fetch->getPetDetailsByChipNum($petChipNum);

    if ($petDetails) {
        echo json_encode([
            "status" => "success",
            "type" => "single_pet_chip",
            "details" => $petDetails,
            "records" => $fetch->getPetRecords($petDetails['PetID']),
            "latest_record" => $fetch->getLatestPetRecord($petDetails['PetID'])
        ]);
    } else {
        echo json_encode([ "status" => "not_found", "message" => "No pet found with that Microchip Number." ]);
    }

} catch (Exception $e) {
    echo json_encode([ "status" => "error", "message" => $e->getMessage() ]);
}
?>
