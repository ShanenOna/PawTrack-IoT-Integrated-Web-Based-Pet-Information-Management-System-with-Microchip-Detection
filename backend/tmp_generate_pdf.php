<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/vet-class.php';

// Create Vet instance using $pdo from db.php
if (!isset($pdo) || !$pdo) {
    echo "Missing PDO instance in db.php\n";
    exit(1);
}

$vet = new Vet($pdo);
$petID = 'P002';

$vet->downloadFullPetRecord($petID);

echo "Finished\n";
