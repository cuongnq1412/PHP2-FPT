<?php

namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\User;

class UserController
{
    private $db; // Biến kết nối cơ sở dữ liệu

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function index()
    {
        include('./src/Views/admin/user/add_user.php');
    }

   
    public function addUserController() {
            // Kiểm tra xem dữ liệu từ form đã được gửi hay chưa
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Kiểm tra xem các trường tiêu đề và nội dung của bài viết đã được gửi hay chưa
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    // Lấy dữ liệu từ form
                    $title = $_POST['title'];
                    $content = $_POST['content'];
    
                    // Khởi tạo một instance của lớp Post
                    $postModel = new Post($this->db);
    
                    // Dữ liệu để thêm vào cơ sở dữ liệu
                    $data = [
                        'title' => $title,
                        'content' => $content
                    ];
    
                    // Gọi phương thức add từ model để thêm bài viết
                    $success = $postModel->addPost($data);
    
                    // Kiểm tra xem việc thêm bài viết có thành công hay không và thực hiện hành động phù hợp
                    if ($success) {
                        // Nếu thành công, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công
                        echo '<script>alert("Bài viết đã được thêm thành công!");</script>';
                
                        // Chuyển hướng người dùng tới trang khác sau khi thêm bài viết thành công
                        echo '<script>window.location.href = "addpost";</script>';
                        exit(); 

                    } else {
                        // Nếu không thành công, bạn có thể hiển thị thông báo lỗi
                        echo "Có lỗi xảy ra khi thêm bài viết!";
                    }
                }}}
             
    

    public function remove()
    {
      
    }
}