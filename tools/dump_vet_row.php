<?php
require_once __DIR__ . '/../backend/db.php';
$db = (new DBConnect())->getConnection();
if (!$db) { echo "DB connect failed\n"; exit(1); }
$id = $argv[1] ?? 'V004';
$stmt = $db->prepare('SELECT * FROM vet WHERE VetID = ?');
$stmt->bind_param('s', $id);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();
if (!$row) { echo "No row for $id\n"; exit(0); }
foreach ($row as $k => $v) {
    echo "$k: ";
    if (is_null($v)) echo "NULL\n"; else echo "$v\n";
}
?>