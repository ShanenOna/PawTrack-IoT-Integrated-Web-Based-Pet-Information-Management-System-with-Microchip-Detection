<?php
require_once __DIR__ . '/../backend/db.php';
$db = (new DBConnect())->getConnection();
if (!$db) { echo "DB connect failed\n"; exit(1); }
$res = $db->query('SHOW COLUMNS FROM vet');
if (!$res) { echo "ERROR: " . $db->error . "\n"; exit(1); }
while ($row = $res->fetch_assoc()) {
    echo $row['Field'] . PHP_EOL;
}
?>