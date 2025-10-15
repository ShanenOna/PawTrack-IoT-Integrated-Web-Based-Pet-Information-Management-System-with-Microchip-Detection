<?php
class db_connect
{
    protected $conn;

    public function connect()
    {
        $this->conn = new mysqli("localhost", "root", "", "pawtrack");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>