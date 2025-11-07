<?php
session_start();
require_once __DIR__ . '/db.php';

$db = new DBConnect();
$conn = $db->connect();

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}

date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
        exit();
    }

    if ($data['action'] === 'register') {
        $fname = trim($data['fname']);
        $lname = trim($data['lname']);
        $email = trim($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $log = "Active";
        $pic = "/assets/images/profile.png";

        //Check if email already exists
        $checkEmail = $conn->prepare("SELECT ClientID FROM client WHERE ClientEmail = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            echo json_encode(["status" => "error", "message" => "Email already exists. Please use another one."]);
            exit();
        }

        // Get last ClientID
        $lastID = $conn->query("SELECT ClientID FROM client ORDER BY ClientID DESC LIMIT 1");

        if ($lastID->num_rows > 0) {
            $row = $lastID->fetch_assoc();
            $curr_id = $row['ClientID']; // corrected casing
            $num = intval(substr($curr_id, 1)) + 1;
            $new_id = 'C' . str_pad($num, 3, '0', STR_PAD_LEFT);
        } else {
            $new_id = 'C001';
        }

        // Insert new client
        $stmt = $conn->prepare("
            INSERT INTO client (
                ClientID,
                ClientFName,
                ClientLName,
                ClientEmail,
                ClientPassword,
                ClientStartDate,
                ClientLog,
                ClientPic
            ) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)
        ");


        $stmt->bind_param("sssssss",
            $new_id,
            $fname,
            $lname,
            $email,
            $password,
            $log,
            $pic
        );


        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Account created"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error inserting account"]);
        }
    }
}
?>
