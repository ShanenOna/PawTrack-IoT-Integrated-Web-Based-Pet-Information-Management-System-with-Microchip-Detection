<?php
require_once(__DIR__ . "/db.php");
require_once(__DIR__ . "/vet-class.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['PetID'])) {
    $petID = $_POST['PetID'];

    $vet = new Vet($pdo);
    $vet->downloadFullPetRecord($petID);
} else {
    http_response_code(400);
    echo "Invalid request. PetID required.";
}
?>
