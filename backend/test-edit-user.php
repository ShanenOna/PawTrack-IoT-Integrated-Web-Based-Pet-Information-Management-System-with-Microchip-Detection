<?php
include 'fetch-users.php'; // Make sure this file loads your DB connection class

$fetch = new FetchUsers();
$fetch->getConnection();

$id = 'V007'; // existing vet ID
$newName = 'Dr. Try Test';
$newEmail = 'trytest@example.com';
$vetSpec = 'Dermatology';
$vetLicense = 'LIC1234';
$vetExp = '5 years';
$vetContact = '09123456789';
$clinicBranch = 'Main Branch';

// Split name
$nameParts = explode(" ", $newName, 2);
$fname = $nameParts[0];
$lname = $nameParts[1] ?? "";

// Table mapping (for this test)
$source = [
    'table' => 'vet',
    'idCol' => 'VetID',
    'fname' => 'VetFName',
    'lname' => 'VetSName',
    'email' => 'VetEmail',
    'pic' => 'VetPic'
];

// Build dynamic update
$candidateCols = [
    $source['fname'] => $fname,
    $source['lname'] => $lname,
    $source['email'] => $newEmail,
    'VetSpecialization' => $vetSpec,
    'VetLicenseNo' => $vetLicense,
    'VetExperience' => $vetExp,
    'VetContact' => $vetContact,
    'ClinicBranch' => $clinicBranch
];

// Get existing table columns
$colsRes = $fetch->conn->query("SHOW COLUMNS FROM {$source['table']}");
$existingCols = [];
while ($row = $colsRes->fetch_assoc()) {
    $existingCols[] = $row['Field'];
}

// Build query
$setParts = [];
$values = [];
foreach ($candidateCols as $col => $val) {
    if (in_array($col, $existingCols)) {
        $setParts[] = "{$col} = ?";
        $values[] = $val;
    }
}

$setSql = implode(', ', $setParts);
$sql = "UPDATE {$source['table']} SET {$setSql} WHERE {$source['idCol']} = ?";

echo "<pre>SQL: {$sql}\nValues:\n";
print_r($values);
echo "</pre>";

$stmt = $fetch->conn->prepare($sql);
if (!$stmt) die("Prepare failed: " . $fetch->conn->error);

$types = str_repeat('s', count($values) + 1);
$values[] = $id;

// bind_param needs references
$bindNames = array_merge([$types], $values);
$refs = [];
foreach ($bindNames as $k => $v) {
    $refs[$k] = &$bindNames[$k];
}

call_user_func_array([$stmt, 'bind_param'], $refs);

$execOk = $stmt->execute();
if (!$execOk) {
    echo "❌ Error: " . $stmt->error;
} else {
    echo "✅ Success! Rows affected: " . $fetch->conn->affected_rows;
}
