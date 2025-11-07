<?php
require_once __DIR__ . '/db.php';
date_default_timezone_set('Asia/Manila');

class fetchClass extends DBConnect
{


    public function __construct()
    {
        // Get the connection from DBConnect
        $this->conn = $this->connect();
        if (!$this->conn) {
            throw new Exception("Database connection failed");
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getClientPets($clientID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pet WHERE ClientID = ?");
        $stmt->bind_param("s", $clientID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientAppointments($clientID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM appointment WHERE ClientID = ?");
        $stmt->bind_param("s", $clientID); // changed "i" to "s" because ClientID is varchar
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPetDetails($petID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pet WHERE PetID = ?");
        $stmt->bind_param("s", $petID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPetRecords($petID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM medhistory WHERE PetID = ?");
        $stmt->bind_param("s", $petID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestPetRecord($petID)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM medhistory 
            WHERE PetID = ? 
            ORDER BY Date DESC 
            LIMIT 1
        ");
        $stmt->bind_param("s", $petID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPetVeterinary($vetID)
    {
        $stmt = $this->conn->prepare("SELECT * FROM vet WHERE VetID = ?");
        $stmt->bind_param("s", $vetID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPetDetailsByChipNum($petChipNum)
    {
        $stmt = $this->conn->prepare("SELECT * FROM pet WHERE PetChipNum = ?");
        $stmt->bind_param("s", $petChipNum);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    /**
     * Fetch client details by ClientID
     * Returns associative array with keys matching frontend expectations
     */
    public function getClientDetails($clientID)
    {
        $stmt = $this->conn->prepare("SELECT ClientID, ClientFName AS FirstName, ClientLName AS LastName, ClientEmail AS Email, ClientStartDate AS CreatedAt, ClientPic FROM client WHERE ClientID = ?");
        $stmt->bind_param("s", $clientID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
