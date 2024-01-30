<?php

namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\Post;

class PostController
{
    private $db; // Biến kết nối cơ sở dữ liệu

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function index()
    {
        include('./src/Views/admin/post/add_post.php');
    }

   
    public function addPostController() {
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
                    $success = $postModel->addPost( $data);
    
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
             
    public function updatePostController() {
                        // Kiểm tra xem có dữ liệu gửi đi từ form không
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Kiểm tra xem các trường cần thiết đã được gửi hay không
                        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
                            // Lấy thông tin bài viết từ form
                            $post_id = $_POST['id'];
                            $title = $_POST['title'];
                            $content = $_POST['content'];

                            // Kiểm tra xem bài viết có tồn tại trong CSDL hay không
                            $postModel = new Post($this->db);
                            $post = $postModel->getPostById($post_id);
                            // Dữ liệu để thêm vào cơ sở dữ liệu
                                $data = [
                                    'title' => $title,
                                    'content' => $content
                                ];
                            if ($post) {
                                // Thực hiện cập nhật bài viết trong CSDL
                                $updated = $postModel->updatePost($post_id,$data);
                                if ($updated) {
                                    // Nếu cập nhật thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                                    echo "Cập nhật bài viết thành công!";
                                } else {
                                    // Nếu không cập nhật được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                                    echo "Đã xảy ra lỗi khi cập nhật bài viết!";
                                }
                            } else {
                                // Nếu không tìm thấy bài viết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                                echo "Không tìm thấy bài viết với ID này!";
                            }
                        } else {
                            // Nếu không đủ dữ liệu cần thiết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                            echo "Không đủ dữ liệu để cập nhật bài viết!";
                        }
                    }


                } 
    public function getPostByIdController($id) {  
                // Kiểm tra xem ID bài viết đã được cung cấp hay không
                if (!empty($id)) {
                    // Khởi tạo một instance của lớp Post
                    $postModel = new Post($this->db);
                    // Gọi phương thức để lấy thông tin bài viết theo ID từ model
                    $post = $postModel->getPostById($id);
                    // Kiểm tra xem bài viết có tồn tại hay không
                    if ($post) {
                        // Trả về thông tin bài viết để sử dụng trong view hoặc xử lý tiếp
                        include('./src/Views/admin/post/update_post.php');
                    } else {
                        // Nếu không tìm thấy bài viết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
                        echo "Không tìm thấy bài viết với ID này!";
                        return null;
                    }
                } else {
                    // Nếu không có ID bài viết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
                    echo "Không có ID bài viết được cung cấp!";
                    return null;
                }
                }

    public function deletePostController($id){
                // Kiểm tra xem bài viết có tồn tại trong CSDL hay không
                $postModel = new Post($this->db);
                $post = $postModel->getPostById($id);
                if ($post) {
                  
                    $deleted = $postModel->deletePostById($id);
                    if ($deleted) {
                        // Nếu xóa thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                        echo "Xóa bài viết thành công!";
                    } else {
                        // Nếu không xóa được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                        echo "Đã xảy ra lỗi khi xóa bài viết!";
                    }
                } else {
                    // Nếu không tìm thấy bài viết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                    echo "Không tìm thấy bài viết với ID này!";
                }
          
        
    }
   
}