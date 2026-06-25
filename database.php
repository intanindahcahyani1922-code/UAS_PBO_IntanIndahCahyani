<?php
// FILE: database.php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "DB_UAS_PBO_TI1D_IntanIndahCahyani"; // Nama database UAS kamu
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Koneksi database gagal: " . $this->conn->connect_error);
        }
    }
}