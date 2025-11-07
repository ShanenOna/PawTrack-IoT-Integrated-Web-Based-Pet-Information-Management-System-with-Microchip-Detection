<?php
header('Content-Type: application/json');
include 'fetch-users.php'; // adjust path if needed

// Get the raw POST data (JSON)
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || !isset($input['id']) || !isset($input['role'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameters (id and role).'
    ]);
    exit();
}

$userId = $input['id'];
$role = $input['role'];

$fetch = new FetchUsers();
$conn = $fetch->getConnection(); // access the DB connection

// Determine table and ID column
switch ($role) {
    case "admin":
        $table = "admin";
        $idColumn = "AdminID";
        break;
    case "vet":
        $table = "vet";
        $idColumn = "VetID";
        break;
    case "client":
        $table = "client";
        $idColumn = "ClientID";
        break;
    default:
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid role provided.'
        ]);
        exit();
}

// Prepare delete query
$stmt = $conn->prepare("DELETE FROM $table WHERE $idColumn = ?");
$stmt->bind_param("s", $userId);

try {
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => ucfirst($role) . " deleted successfully."
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete user.'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}

$stmt->close();
$conn->close();
