<?php
session_start();
include 'db.php';
date_default_timezone_set('Asia/Manila');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginType = $_POST['loginType'];
    if ($loginType === 'client') {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT ClientID, ClientFName, ClientLName, ClientPassword FROM client WHERE ClientEmail = ?");
        if (!$stmt) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
            exit();
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $fname, $sname, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['ClientID'] = $id;
                $_SESSION['ClientFName'] = $fname;
                $_SESSION['ClientSName'] = $sname;

                echo json_encode(["status" => "success", "message" => "Login successful"]);
                exit();
            } else {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Invalid password"]);
            }
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "Email not found"]);
        }

        $stmt->close();
    }

    $conn->close();
}
?>