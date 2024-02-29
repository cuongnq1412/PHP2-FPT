<?php

namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\Post;
use Src\Models\Home;

class PostController
{
    private $db; // Biến kết nối cơ sở dữ liệu

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }
    public function includeHeader() {
        $homeModel = new Home($this->db);
        $check= $homeModel->isUserLoggedIn();
        if($check){
            global $url;
            include(__DIR__.'../../Views/admin/inc/header.php');
        }else{
            header('Location: '.BASE_URLC.'Home'); 
            
        }
    }
    public function includeFooter(){
        global $url;
        include(__DIR__.'../../Views/admin/inc/footer.php');  

    }

    public function index()
    {
        $this->includeHeader();
        include('./src/Views/admin/post/add_post.php');
        $this->includeFooter();

    }
// người dùng
   public function renderPostsController(){
    include(__DIR__ . '/../Views/inc/header.php');
   
    
    include('./src/Views/blog.php');
    include(__DIR__ . '/../Views/inc/footer.php');
   }



// admin

   
    public function addPostController() {
            // Kiểm tra xem dữ liệu từ form đã được gửi hay chưa
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Kiểm tra xem các trường tiêu đề và nội dung của bài viết đã được gửi hay chưa
                if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['description']) && isset($_FILES['imgpost'])) {
                    // Lấy dữ liệu từ form
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $user_id = $_POST['user_id'];
                    $description = $_POST['description'];
                    $file=$_FILES['imgpost'];
    
                    // Khởi tạo một instance của lớp Post
                    $postModel = new Post($this->db);
    
                    // Dữ liệu để thêm vào cơ sở dữ liệu
                    $data = [
                        'title' => $title,
                        'content' => $content,
                        'user_id'=> $user_id,
                        'description'=>$description
                    ];
    
                    // Gọi phương thức add từ model để thêm bài viết
                    $success = $postModel->addPost( $data ,$file);
    
                    // Kiểm tra xem việc thêm bài viết có thành công hay không và thực hiện hành động phù hợp
                    if ($success) {
                        // Nếu thành công, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                          Swal.fire({
                            title: "Bài viết đã được thêm thành công!",
                            icon: "success"
                          }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.href = "'.BASE_URL.'/admin/addpost";
                            }
                          });
                        </script>';
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
                        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['description']) && isset($_FILES['imgpost'])) {
                            
                            $post_id= $_POST['post_id'];
                            $title = $_POST['title'];
                            $content = $_POST['content'];
                            $user_id = $_POST['user_id'];
                            $description = $_POST['description'];
                            $file=$_FILES['imgpost'];
            

                            // Kiểm tra xem bài viết có tồn tại trong CSDL hay không
                            $postModel = new Post($this->db);
                            $post = $postModel->getPostById($post_id);
                            // Dữ liệu để thêm vào cơ sở dữ liệu
                                $data = [
                                    'user_id' => $post_id,

                                    'title' => $title,
                                    'content' => $content,
                                    'user_id'=> $user_id,
                                    'description'=>$description
                                ];
                            if ($post) {
                                // Thực hiện cập nhật bài viết trong CSDL
                                $updated = $postModel->updatePost($post_id,$data,$file);
                                if ($updated) {
                                   
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
                                      Swal.fire({
                                        title: "Cập nhật thành công!",
                                        icon: "success"
                                      }).then((result) => {
                                        if (result.isConfirmed) {
                                          window.location.href = "'.BASE_URL.'/admin/listpost";
                                        }
                                      });
                                    </script>';
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
                        $this->includeHeader();
                    include('./src/Views/admin/post/update_post.php');

                    $this->includeFooter();

                        
                        
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

                public function getAllPostController(){
                    $this->includeHeader();
                    $postModel = new Post($this->db);
                    $data = $postModel->getPostAll();
            
                    include('./src/Views/admin/post/list_post.php');
                    $this->includeFooter();
                     
                  
            
            }
    public function deletePostController($id){
                // Kiểm tra xem bài viết có tồn tại trong CSDL hay không
                $postModel = new Post($this->db);
                $post = $postModel->getPostById($id);
                if ($post) {
                  
                    $deleted = $postModel->deletePostById($id);
                    if ($deleted) {
                        // Nếu xóa thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                          Swal.fire({
                            title: "Đã xóa !",
                            icon: "success"
                          }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.href = "'.BASE_URL.'/admin/listpost";
                            }
                          });
                        </script>';
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