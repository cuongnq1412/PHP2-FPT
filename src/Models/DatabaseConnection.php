<?php

namespace Src\Models;

use mysqli;

class DatabaseConnection {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "demo_11";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        // Kiểm tra nếu kết nối đã được thiết lập hoặc có lỗi
        if ($this->conn === null || $this->conn->connect_error) {
            // Thử kết nối lại
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }

        return $this->conn;
    }
}

?>