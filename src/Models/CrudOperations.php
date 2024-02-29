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

    public function getById($table,$name_id, $id) {
        $query = "SELECT * FROM $table WHERE $name_id = $id";
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
                // return true ;
                $lastInsertedId = $this->db->conn->insert_id;
                return $lastInsertedId;
            } else {
                return false;
            }
        }
        
        public function addwithfile($table, $data, $name_id,$file,$column_img) {
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("','", array_values($data)) . "'";
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
        
            if ($this->db->conn->query($query)) {
                // Lấy ID của bản ghi mới được thêm vào
                $lastInsertId = $this->db->conn->insert_id;
        
                // Kiểm tra nếu $file không rỗng và có nội dung được tải lên
                if (!empty($file["tmp_name"])) {
                    // Lưu ảnh vào thư mục upload
                    $uploadDir = "./public/img/admin/".$table."/";
                    $uploadFile = $uploadDir . basename($file["name"]);
        
                    if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                        // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                        $updateQuery = "UPDATE $table SET $column_img = '$uploadFile' WHERE $name_id = $lastInsertId";
                        if ($this->db->conn->query($updateQuery)) {
                            return true;
                        } else {
                            // Nếu không cập nhật được đường dẫn ảnh vào cơ sở dữ liệu, xóa bản ghi đã thêm trước đó
                            $deleteQuery = "DELETE FROM $table WHERE id = $lastInsertId";
                            $this->db->conn->query($deleteQuery);
                            unlink($uploadFile); // Xóa tập tin đã tải lên
                            echo "Lỗi khi cập nhật đường dẫn ảnh vào cơ sở dữ liệu.";
                            return false;
                        }
                    } else {
                        echo "Lỗi khi di chuyển tập tin tải lên.";
                        return false;
                    }
                } else {
                    // Nếu $file rỗng, gán đường dẫn mặc định
                    $defaultImage = "./public/img/admin/user/user.jpg";
                    $updateQuery = "UPDATE $table SET profile_image = '$defaultImage' WHERE $name_id = $lastInsertId";
                    if ($this->db->conn->query($updateQuery)) {
                        return true;
                    } else {
                        echo "Lỗi khi cập nhật đường dẫn ảnh vào cơ sở dữ liệu.";
                        return false;
                    }
                }
            } else {
                echo "Lỗi khi thêm dữ liệu vào cơ sở dữ liệu.";
                return false;
            }
        }
        
        public function addwithfileProduct($table, $data, $files) {
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("','", array_values($data)) . "'";
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            
            if ($this->db->conn->query($query)) {
                // Lấy ID của bản ghi mới được thêm vào
                $lastInsertId = $this->db->conn->insert_id;
                
                // Lưu ảnh vào thư mục upload
                $uploadDir = "./public/img/admin/product/";
                $success = true;
        
                foreach ($files["tmp_name"] as $key => $tmp_name) {
                    $uploadFile = $uploadDir . basename($files["name"][$key]);
                    if (!move_uploaded_file($tmp_name, $uploadFile)) {
                        $success = false;
                        break;
                    }
        
                  
                    $insertImgQuery = "INSERT INTO product_images (product_id, image_path) VALUES ($lastInsertId, '$uploadFile')";
                    if (!$this->db->conn->query($insertImgQuery)) {
                       
                        $deleteQuery = "DELETE FROM $table WHERE product_id = $lastInsertId";
                        $this->db->conn->query($deleteQuery);
                        unlink($uploadFile); // Xóa tập tin đã tải lên
                        $success = false;
                        break;
                    }
                }
        
                if ($success) {
                    return true;
                } else {
                    echo "Lỗi khi xử lý tập tin ảnh.";
                    return false;
                }
            } else {
                echo "Lỗi khi thêm dữ liệu vào cơ sở dữ liệu.";
                return false;
            }
        }
        public function updateProduct($table,$id, $data, $files) {
            // Lấy ID của sản phẩm cần cập nhật
          
        
            // Xử lý dữ liệu cần cập nhật
            $updateData = array();
            foreach ($data as $key => $value) {
                if ($key !== 'product_id') {
                    $updateData[] = "$key = '$value'";
                }
            }
            $updateValues = implode(', ', $updateData);
        
            // Thực hiện truy vấn cập nhật thông tin sản phẩm
            $query = "UPDATE $table SET $updateValues WHERE product_id = $id";
        
            if ($this->db->conn->query($query)) {
                // Nếu không có tệp ảnh mới được tải lên, giữ nguyên ảnh cũ
                if (!empty($files['name'][0])) {
                    // Xóa tất cả ảnh cũ của sản phẩm từ thư mục lưu trữ
                    $deleteImgQuery = "DELETE FROM product_images WHERE product_id = $id";
                    $this->db->conn->query($deleteImgQuery);
        
                    // Lưu ảnh mới vào thư mục upload và cập nhật đường dẫn ảnh trong cơ sở dữ liệu
                    $uploadDir = "./public/img/admin/product/";
                    $success = true;
        
                    foreach ($files["tmp_name"] as $key => $tmp_name) {
                        $uploadFile = $uploadDir . basename($files["name"][$key]);
                        if (!move_uploaded_file($tmp_name, $uploadFile)) {
                            $success = false;
                            break;
                        }
        
                        // Thêm đường dẫn ảnh vào cơ sở dữ liệu
                        $insertImgQuery = "INSERT INTO product_images (product_id, image_path) VALUES ($id, '$uploadFile')";
                        if (!$this->db->conn->query($insertImgQuery)) {
                            $success = false;
                            break;
                        }
                    }
        
                    if ($success) {
                        return true;
                    } else {
                        echo "Lỗi khi xử lý tập tin ảnh.";
                        return false;
                    }
                } else {
                    // Nếu không có tệp ảnh mới được tải lên, giữ nguyên ảnh cũ
                    return true;
                }
            } else {
                echo "Lỗi khi cập nhật dữ liệu vào cơ sở dữ liệu.";
                return false;
            }
        }
        
        
        
        
    
    //



    
    public function update($table, $id,$name_id, $data) {
        $setClause = implode(', ', array_map(function ($key, $value) {
            return "$key='$value'";
        }, array_keys($data), $data));
        $query = "UPDATE $table SET $setClause WHERE $name_id = $id";

        if ($this->db->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateWithImage($table,$name_id, $id, $data, $file) {
        $setClause = '';
    
        // Xử lý trường dữ liệu img một cách riêng biệt
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "./public/img/admin/".$table."/";
            $uploadFile = $uploadDir . basename($file["name"]);
    
            if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                $data['img'] = $uploadFile;
            } else {
                return false;
            }
        }
    
        // Xử lý các trường dữ liệu khác
        foreach ($data as $key => $value) {
            if ($key !== 'img') {
                $setClause .= "$key='$value', ";
            }
        }
    
        // Thêm trường dữ liệu img vào câu truy vấn SQL
        if (isset($data['img'])) {
            $setClause .= "img='{$data['img']}', ";
        }
    
        // Loại bỏ dấu phẩy cuối cùng và khoảng trắng
        $setClause = rtrim($setClause, ', ');
    
        // Tạo câu truy vấn SQL
        $query = "UPDATE $table SET $setClause WHERE $name_id = $id";
    
        // Thực hiện truy vấn SQL
        if ($this->db->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function delete($table, $name_id,$id) {
        $query = "DELETE FROM $table WHERE $name_id = $id";

        if ($this->db->conn->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    
    }
?>