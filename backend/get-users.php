<?php
header('Content-Type: application/json');
include 'fetch-users.php';

$fetch = new FetchUsers();

try {
    $users = $fetch->getUsers();  // returns array
    echo json_encode($users);      // encode here once for HTTP
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch users',
        'error' => $e->getMessage()
    ]);
}
?>
