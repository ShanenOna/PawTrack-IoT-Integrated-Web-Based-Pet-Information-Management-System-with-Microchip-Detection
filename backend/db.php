<?php
class DBConnect
{
    protected $conn;

    public function connect()
    {
        $this->conn = new mysqli("localhost", "root", "", "pawtrack");
        if ($this->conn->connect_error) {
            return null; 
        }
        return $this->conn;
    }

    public function getConnection()
    {
        if (!$this->conn) {
            $this->connect();
        }
        return $this->conn;
    }
}


if (!isset($pdo)) {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=pawtrack;charset=utf8mb4', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Do not echo or print errors here; let calling code handle connection issues.
        $pdo = null;
    }
}
?>
