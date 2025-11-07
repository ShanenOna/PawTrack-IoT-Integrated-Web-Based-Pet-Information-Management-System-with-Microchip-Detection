<?php
require_once __DIR__ . '/db.php';
date_default_timezone_set('Asia/Manila');

class FetchUsers extends DBConnect {
    public $conn;

    public function __construct() {
        $this->connect();
        $this->conn = $this->getConnection();
    }

    /**
     * Fetch all admin users
     */
    public function getAdmins() {
        $query = $this->conn->prepare("SELECT AdminID, AdminFName, AdminSName, AdminEmail, AdminLog, AdminStartDate, AdminPic FROM admin");
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Fetch all veterinarian users
     */
    public function getVets() {
        $query = $this->conn->prepare("SELECT VetID, VetFName, VetSName, VetEmail, VetLog, VetStartDate, VetPic FROM vet");
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Fetch all client users
     */
    public function getClients() {
        $query = $this->conn->prepare("SELECT ClientID, ClientFName, ClientLName, ClientEmail, ClientLog, ClientStartDate, ClientPic FROM client");
        $query->execute();
        return $query->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Fetch all users in one array
     */
    public function getUsers() {
        return [
            "admins"  => $this->getAdmins(),
            "vets"    => $this->getVets(),
            "clients" => $this->getClients()
        ];
    }

    /**
     * Optional: fetch a single user by ID and role
     */
    public function getUserByID($role, $id) {
        $table = "";
        $idColumn = "";

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
                return null;
        }

        $query = $this->conn->prepare("SELECT * FROM $table WHERE $idColumn = ?");
        $query->bind_param("s", $id);
        $query->execute();
        return $query->get_result()->fetch_assoc();
    }
}
?>
