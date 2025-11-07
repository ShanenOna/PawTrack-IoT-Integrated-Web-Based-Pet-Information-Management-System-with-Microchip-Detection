<?php
require_once __DIR__ . '/../backend/db.php';
$db = (new DBConnect())->getConnection();
if (!$db) { echo "DB connect failed\n"; exit(1); }
$res = $db->query("SELECT * FROM vet WHERE VetID = 'V004'");
if (!$res) { echo "ERROR: " . $db->error . "\n"; exit(1); }
$row = $res->fetch_assoc();
echo json_encode($row, JSON_PRETTY_PRINT);
?>