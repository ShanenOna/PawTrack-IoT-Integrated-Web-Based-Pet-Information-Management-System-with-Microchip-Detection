<?php
header("Content-Type: application/json");

// Include DB class and client session
require_once __DIR__ . "/db.php";
require_once __DIR__ . "/../frontend/partials/client-session.php"; // Adjust path

try {
    // Initialize DB connection
    $db = new DBConnect();
    $conn = $db->getConnection();
    if (!$conn) {
        echo json_encode(["status" => "error", "message" => "Database connection failed."]);
        exit;
    }

    // Required fields
    $required = ['PetChipNum','PetName','Species','Breed','Gender','Age','Weight','ColorMarkings'];
    foreach ($required as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            echo json_encode([
                "status" => "error",
                "message" => "Field {$field} is required."
            ]);
            exit;
        }
    }

    $PetChipNum = $_POST['PetChipNum'];
    $PetName = $_POST['PetName'];
    $Species = $_POST['Species'];
    $Breed = $_POST['Breed'];
    $Gender = $_POST['Gender'];
    $Age = $_POST['Age'];
    $Weight = $_POST['Weight'];
    $ColorMarkings = $_POST['ColorMarkings'];

    $ClientID = $_SESSION['ClientID'] ?? null;
    $StaffID = $_SESSION['StaffID'] ?? null;

    if (!$ClientID) {
        echo json_encode(["status"=>"error","message"=>"Client not logged in."]);
        exit;
    }

    // Generate new PetID
    $result = $conn->query("SELECT PetID FROM pet ORDER BY PetID DESC LIMIT 1");
    $lastPetID = $result->fetch_assoc()['PetID'] ?? null;

    if ($lastPetID) {
        $num = (int)substr($lastPetID, 1); 
        $num++;
        $PetID = 'P' . str_pad($num, 3, '0', STR_PAD_LEFT);
    } else {
        $PetID = 'P001';
    }

    // Handle file upload
    $PetPic = null;
    if (isset($_FILES['PetPic']) && $_FILES['PetPic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/../storage/images/pets/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $ext = strtolower(pathinfo($_FILES['PetPic']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg','jpeg','png','gif'])) {
            echo json_encode(["status"=>"error","message"=>"Invalid image type."]);
            exit;
        }

        $filename = $PetID . "_" . time() . "." . $ext;
        $targetPath = $uploadDir . $filename;

        if (!move_uploaded_file($_FILES['PetPic']['tmp_name'], $targetPath)) {
            echo json_encode(["status"=>"error","message"=>"Failed to upload pet image."]);
            exit;
        }
        $PetPic = $filename;
    }

    // Insert pet into DB
    $stmt = $conn->prepare("INSERT INTO pet (PetID, StaffID, ClientID, PetChipNum, PetName, Species, Breed, Gender, Age, Weight, ColorMarkings, PetPic) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $PetID, $StaffID, $ClientID, $PetChipNum, $PetName, $Species, $Breed, $Gender, $Age, $Weight, $ColorMarkings, $PetPic);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Pet added successfully!",
            "PetID" => $PetID,
            "PetPic" => $PetPic
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Database insert failed: " . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(["status"=>"error","message"=>$e->getMessage()]);
}
?>
