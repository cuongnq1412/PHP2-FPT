<?php
// class Database {
//     private $host = "localhost"; // Thay đổi hostname nếu cần
//     private $username = "root"; // Thay đổi username
//     private $password = ""; // Thay đổi password
//     private $database = "polynews"; // Thay đổi tên cơ sở dữ liệu

//     public $conn;

//     public function __construct() {
//         $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

//         if ($this->conn->connect_error) {
//             die("Connection failed: " . $this->conn->connect_error);
//         }
//     }

    
// }
namespace Src\Models;

class CrudOperations {
   
    private $db;

    public function __construct() {
        $this->db = new DatabaseConnection(); 
    }

    public function getAll($table) {
        $query = "SELECT * FROM $table";
        $result = $this->db->conn->query($query);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getById($table, $id) {
        $query = "SELECT * FROM $table WHERE id = $id";
        $result = $this->db->conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    //
  
        public function add($table, $data) {
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("','", array_values($data)) . "'";
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
    
            if ($this->db->conn->query($query)) {
                return true;
            } else {
                return false;
            }
        }
        
        public function addwithfile($table, $data, $file) {
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("','", array_values($data)) . "'";
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
        
            if ($this->db->conn->query($query)) {
                // Lấy ID của bản ghi mới được thêm vào
                $lastInsertId = $this->db->conn->insert_id;
        
                // Lưu ảnh vào thư mục upload
                $uploadDir = "upload/";
                $uploadFile = $uploadDir . basename($file["name"]);
        
                if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                    // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                    $updateQuery = "UPDATE $table SET image = '$uploadFile' WHERE News_ID = $lastInsertId";
                    $this->db->conn->query($updateQuery);
        
                    return true;
                } else {
                    echo "Error: " . $this->db->conn->error;
                    return false;
                }
            } else {
                return false;
            }
        }
        
    
    //

    private function updateImagePath($table, $id, $imagePath) {
        $updateImageQuery = "UPDATE $table SET image_path = '$imagePath' WHERE id = $id";
        $this->db->conn->query($updateImageQuery);
    }

    
    public function update($table, $id, $data) {
        $setClause = implode(', ', array_map(function ($key, $value) {
            return "$key='$value'";
        }, array_keys($data), array_values($data)));
        $query = "UPDATE $table SET $setClause WHERE id = $id";

        if ($this->db->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateWithImage($table, $id, $data, $imagePath) {
        // Cập nhật dữ liệu trong bảng
        $setClause = implode(', ', array_map(function ($key, $value) {
            return "$key='$value'";
        }, array_keys($data), array_values($data)));
        $query = "UPDATE $table SET $setClause WHERE id = $id";

        if ($this->db->conn->query($query)) {
            // Cập nhật đường dẫn ảnh nếu có
            if (!empty($imagePath)) {
                $this->updateImagePath($table, $id, $imagePath);
            }

            return true;
        } else {
            return false;
        }
    }
    public function delete($table, $id) {
        $query = "DELETE FROM $table WHERE id = $id";

        if ($this->db->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }
}
?>