<?php
include 'db.php';
date_default_timezone_set('Asia/Manila');

class fetchClass extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function getClientPets($clientID)
    {
        $query = $this->conn->prepare("SELECT * FROM pet WHERE ClientID = ?");
        $query->bind_param("s", $clientID);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getClientAppointments($clientID)
    {
        $query = $this->conn->prepare("SELECT * FROM appointment WHERE ClientID = ?");
        $query->bind_param("i", $clientID);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPetDetails($petID)
    {
        $query = $this->conn->prepare("SELECT * FROM pet WHERE PetID = ?");
        $query->bind_param("s", $petID);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function getPetRecords($petID)
    {
        $query = $this->conn->prepare("SELECT * FROM medhistory WHERE PetID = ?");
        $query->bind_param("s", $petID);
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestPetRecord($petID)
    {
        $query = $this->conn->prepare("
        SELECT * FROM medhistory 
        WHERE PetID = ? 
        ORDER BY Date DESC 
        LIMIT 1
    ");
        $query->bind_param("s", $petID);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }

    public function getPetVeterinary($vetID)
    {
        $query = $this->conn->prepare("SELECT * FROM vet WHERE VetID = ?");
        $query->bind_param("s", $vetID);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }
}
?>