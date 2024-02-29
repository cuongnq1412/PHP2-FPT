<?php

// src/Models/Post.php

namespace Src\Models;
use Src\Models\CrudOperations;


class User {
    
    private $crud;
    private $db;

    public function __construct() {
        $this->crud = new CrudOperations();
        $this->db = new DatabaseConnection(); 
    }

    public function addUser($data,$file) {
        return $this->crud->addwithfile('user', $data,'user_id', $file,'profile_image');
    }
   
    public function updateUser($id,$data,$file) {
        return $this->crud->updateWithImage('user', $id, $data, $file) ;
    } 
    public function updateProfile($id,$data) {
        return $this->crud->update('user', $id,'user_id', $data) ;
    } 
    public function getUserById($id) {
        return $this->crud->getById('user','user_id', $id) ;
    }
    public function deleteUserById($id) {
        return $this->crud->delete('user','user_id', $id) ;
    }
    public function authenticate($username, $password){
        // Chuẩn bị truy vấn SQL để kiểm tra thông tin đăng nhập
        $query = "SELECT * FROM user WHERE user_name = '$username' AND user_password = '$password'";
        $result = $this->db->conn->query($query);
    
            // Kiểm tra xem truy vấn có lỗi không
        if (!$result) {
            // Xuất thông báo lỗi
            echo "Query error: " . $this->db->conn->error;
            return false;
        }

        // Kiểm tra xem có bản ghi nào khớp hay không
        if ($result->num_rows > 0) {
            
            $user_data = $result->fetch_assoc();
    
            // Lưu thông tin người dùng vào session
            // session_start();
            $_SESSION['user'] = $user_data;
    
            // Đóng kết nối
            $this->db->conn->close();
    
            return true;
        } else {
            // Đăng nhập không thành công
            // Đóng kết nối
            $this->db->conn->close();
            return false;
        }
    }
    
    public function getAllUser(){
        return $this->crud->getAll('user') ;
        
    }
    public function updateImageByUserId($table, $user_id, $file) {
        // Đường dẫn thư mục lưu trữ ảnh
        $uploadDir = "./public/img/admin/".$table."/";
    
        // Kiểm tra lỗi upload và xử lý ảnh
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $uploadFile = $uploadDir . basename($file["name"]);
    
            // Di chuyển tệp tải lên vào thư mục lưu trữ
            if (move_uploaded_file($file["tmp_name"], $uploadFile)) {
                // Tạo câu truy vấn SQL để cập nhật hình ảnh
                $query = "UPDATE $table SET profile_image ='$uploadFile' WHERE user_id = $user_id";
    
                // Thực hiện truy vấn SQL
                if ($this->db->conn->query($query)) {
                    return true; // Cập nhật thành công
                } else {
                    return false; // Cập nhật thất bại
                }
            } else {
                return false; // Di chuyển tệp không thành công
            }
        } else {
            return false; // Lỗi khi tải ảnh lên
        }
    }
    
 
  }