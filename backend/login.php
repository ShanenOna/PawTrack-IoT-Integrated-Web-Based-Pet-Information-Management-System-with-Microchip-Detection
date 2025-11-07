<?php
session_start();
require_once __DIR__ . '/fetch-class.php';
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginType = $_POST['loginType'] ?? '';
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $fetch = new fetchClass();
    $conn = $fetch->getConnection();

    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Please fill in all fields."]);
        exit();
    }

    switch ($loginType) {
        case 'client':
            $stmt = $conn->prepare("SELECT ClientID, ClientFName, ClientLName, ClientPassword, ClientStartDate, ClientLog, ClientPic FROM client WHERE ClientEmail = ?");
            break;

        case 'vet':
            $stmt = $conn->prepare("SELECT AdminID, VetID, VetFName, VetSName, VetPassword, VetLog, VetStartDate, VetPic FROM vet WHERE VetEmail = ?");
            break;

        case 'admin':
            $stmt = $conn->prepare("SELECT AdminID, AdminFName, AdminSName, AdminPassword, AdminLog, AdminStartDate, AdminPic FROM admin WHERE AdminEmail = ?");
            break;

        default:
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid login type."]);
            exit();
    }

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        if ($loginType === 'client') {
            $stmt->bind_result($id, $fname, $lname, $hashedPassword, $startDate, $log, $pic);
        } elseif ($loginType === 'vet') {
            $stmt->bind_result($adminID, $id, $fname, $lname, $hashedPassword, $log, $startDate, $pic);
        } else {
            $stmt->bind_result($id, $fname, $lname, $hashedPassword, $log, $startDate, $pic);
        }

        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            if ($loginType === 'client') {
                $_SESSION['ClientID'] = $id;
                $_SESSION['ClientFName'] = $fname;
                $_SESSION['ClientLName'] = $lname;
                $_SESSION['ClientEmail'] = $email;
                $_SESSION['ClientPassword'] = $hashedPassword;
                $_SESSION['ClientLog'] = $log;
                $_SESSION['ClientStartDate'] = $startDate;
                $_SESSION['ClientPic'] = $pic;

            } elseif ($loginType === 'vet') {
                $_SESSION['AdminID'] = $adminID;
                $_SESSION['VetID'] = $id;
                $_SESSION['VetFName'] = $fname;
                $_SESSION['VetSName'] = $lname;
                $_SESSION['VetEmail'] = $email;
                $_SESSION['VetPassword'] = $hashedPassword;
                $_SESSION['VetLog'] = $log;
                $_SESSION['VetStartDate'] = $startDate;
                $_SESSION['VetPic'] = $pic;

            } elseif ($loginType === 'admin') {
                $_SESSION['AdminID'] = $id;
                $_SESSION['AdminFName'] = $fname;
                $_SESSION['AdminSName'] = $lname;
                $_SESSION['AdminEmail'] = $email;
                $_SESSION['AdminPassword'] = $hashedPassword;
                $_SESSION['AdminLog'] = $log;
                $_SESSION['AdminStartDate'] = $startDate;
                $_SESSION['AdminPic'] = $pic;
            }

            echo json_encode(["status" => "success", "message" => "Login successful"]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid password! Password: $password, HashedPassword: $hashedPassword"]);
        }
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Email not found"]);
    }

    $stmt->close();
    $conn->close();
}
?>