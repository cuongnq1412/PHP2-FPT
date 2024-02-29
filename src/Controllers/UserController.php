<?php

namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\User;
use Src\Models\Home;


class UserController
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

    public function renderRegister()
    {
        include('./src/Views/register.php');
    }
    public function renderLogin(){
        include('./src/Views/login.php');

    }
    public function loginController() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username']) && isset($_POST['password']) ){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userModel = new User($this->db);
            $success = $userModel->authenticate($username, $password);
            if ($success) {
                $role = $_SESSION['user']['role'];
                $userid = $_SESSION['user']['user_id'];
                $avt = $_SESSION['user']['profile_image'];
                if($role=='user'){
                    header('Location: Home'); 
                }else{
                    header('Location: admin/addcategory'); 
                }
                exit();
            } else {
                // Nếu đăng nhập không thành công, hiển thị thông báo lỗi hoặc thực hiện các xử lý khác
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                Swal.fire({
                   
                    icon: "error",
                    title: "Tên Người dùng hoặc mật khẩu không chính xác !",
                    text: "Something went wrong!"
                  }).then(() => {
                    window.location.href = "login";
                });;
                  </script>
                ';
            }
         }else{
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            Swal.fire({
                title: " Không được để trống ! ",
                showClass: {
                  popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                  `
                },
                hideClass: {
                  popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                  `
                }
              });
              </script>
            ';
         }
        }
    }

   
    public function addUserController() 
    {
        // Kiểm tra xem dữ liệu từ form đã được gửi hay chưa
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem các trường tiêu đề và nội dung của tài khoản đã được gửi hay chưa
            if (isset($_POST['username']) && isset($_POST['user_username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
                // echo 'concac';
                // Lấy dữ liệu từ form
                $user_name = $_POST['username'];
                $user_username=$_POST['user_username'];
                $password = $_POST['password'];
                $role='user';
                $confirm_password = $_POST['confirm_password'];
                $file=null;
                // Kiểm tra xem mật khẩu và nhập lại mật khẩu có khớp nhau không
                if ($password !== $confirm_password) {
                    echo '<script>alert("Mật khẩu và xác nhận mật khẩu không khớp nhau!");</script>';
                    // Hiển thị thông báo và không thực hiện thêm tài khoản
                } else {
                    // Khởi tạo một instance của lớp User
                    $userModel = new User($this->db);
    
                    // Dữ liệu để thêm vào cơ sở dữ liệu
                    $data = [
                        'user_name' => $user_name,
                        'user_username' => $user_username,
                        'user_password' => $password ,// Bạn cần mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
                        'role'=>$role
                    ];
    
                    // Gọi phương thức add từ model để thêm tài khoản
                    $success = $userModel->addUser($data, $file);
    
                    // Kiểm tra việc thêm tài khoản có thành công hay không và thực hiện hành động phù hợp
                        if ($success) {
                            // Nếu thành công, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công
                            echo '
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            Swal.fire({
                                title: "Tạo tài khoản thành công!",
                                text: "Tiến hành đăng nhập để trải nghiệm!",
                                icon: "success"
                               
                            }).then(() => {
                                window.location.href = "login";
                            });
                            </script>';
                            
                            // Chuyển hướng người dùng tới trang khác sau khi thêm tài khoản thành công
                            exit(); 
                    } else {
                        // Nếu không thành công, bạn có thể hiển thị thông báo lỗi
                        echo '<script>alert("lỗi!");</script>';
                    }
                }
            }else{
                echo 'looxi ';
            }
        }
    }
    
    public function updateUserController(){
        if ($_SERVER["REQUEST_METHOD"] == "user") {
            // Kiểm tra xem các trường cần thiết đã được gửi hay không
            if (isset($_user['id']) && isset($_user['name']) && isset($_FILES['img'])) {
                // Lấy thông tin user từ form
                $user_id = $_user['id'];
                $name = $_user['name'];
                $file= $_FILES['img'];

                // Kiểm tra xem user có tồn tại trong CSDL hay không
                $userModel = new User($this->db);
                $user = $userModel->getUserById($user_id);
                // Dữ liệu để thêm vào cơ sở dữ liệu
                    $data = [
                        'name' => $name,
                        
                   
                    ];
                if ($user) {
                    // Thực hiện cập nhật user trong CSDL
                    $updated = $userModel->updateUser($user_id,$data,$file);
                    if ($updated) {
                        // Nếu cập nhật thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                        echo "Cập nhật user thành công!";
                    } else {
                        // Nếu không cập nhật được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                        echo "Đã xảy ra lỗi khi cập nhật user!";
                    }
                } else {
                    // Nếu không tìm thấy user, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                    echo "Không tìm thấy user với ID này!";
                }
            } else {
                // Nếu không đủ dữ liệu cần thiết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                echo "Không đủ dữ liệu để cập nhật người dùng";
            }
        }


    }
    public function getUserByIdController($id)
     {  
        // Kiểm tra xem ID user đã được cung cấp hay không
        if (!empty($id)) {
            // Khởi tạo một instance của lớp user
            $userModel = new User($this->db);
            // Gọi phương thức để lấy thông tin user theo ID từ model
            $user = $userModel->getUserById($id);
            // Kiểm tra xem user có tồn tại hay không
            if ($user) {
                // Trả về thông tin user để sử dụng trong view hoặc xử lý tiếp
                include('./src/Views/admin/user/update_user.php');
            } else {
                // Nếu không tìm thấy user, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
                echo "Không tìm thấy user với ID này!";
                return null;
            }
        } else {
            // Nếu không có ID user, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
            echo "Không có ID user được cung cấp!";
            return null;
        }
    }
    public function getAllUserController(){
        $this->includeHeader();
        $userModel = new User($this->db);
        $data = $userModel->getAllUser();

        include('./src/Views/admin/user/list_user.php');
        $this->includeFooter();
    }
    

    public function deleteUserController($id){
        // Kiểm tra xem người dùng có tồn tại trong CSDL hay không
        $userModel = new user($this->db);
        $user = $userModel->getUserById($id);
        if ($user) {
          
            $deleted = $userModel->deleteUserById($id);
            if ($deleted) {
                // Nếu xóa thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                  Swal.fire({
                    title: "Đã xóa !",
                    icon: "success"
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = "'.BASE_URL.'/admin/listuser";
                    }
                  });
                </script>';
            } else {
                // Nếu không xóa được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                echo "Đã xảy ra lỗi khi xóa người dùng!";
            }
        } else {
            // Nếu không tìm thấy người dùng, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
            echo "Không tìm thấy người dùng với ID này!";
        }
  

}
    
public function getProfileController(){
        $this->includeHeader();
        include('./src/Views/admin/user/profile.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["addavatar"])) {
                $userid = $_SESSION['user']['user_id'];
                $avataprofile = $_FILES["profileImage"];
        $userModel = new User($this->db);
              
                $sqlavt = $userModel->updateImageByUserId('user',$userid, $avataprofile);
                if ($sqlavt === true) {
                   
               

                    $_SESSION['user']['profile_image'] = './public/img/admin/user/'.$avataprofile['name'].'';
                  
                } else {
                    // Xử lý và hiển thị lỗi
                    echo "<script>alert('Thông tin không được cập nhật!');</script>";
                    // echo $sqlavt["errors"] . "<br>"; // Lưu ý sửa đổi ở đây để truy cập mảng errors
                }
            }elseif (isset($_POST['editinfo'])) {
                $userid = $_SESSION['user']['user_id'];
                
                $Profile = new User($this->db);
                $name = $_POST["user_username"];
                $data = [
                    'user_username' => $name,
                    
                ];
                $sqlinfo = $Profile->updateProfile($userid,$data);
                if ($sqlinfo === true) {
                    // Thông tin đã được cập nhật thành công
                    $_SESSION['user']['user_username'] = $name;
                    echo '
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Cập nhật thông tin thành công !",
                        showConfirmButton: false,
                        timer: 1500
                      });
                    </script>';

                
                    
                } else {
                  
                    echo '
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Cập nhật thông tin Không thành công !",
                        showConfirmButton: false,
                        timer: 1500
                      });
                    </script>';
                     
                }
                }
                
                elseif (isset($_POST['editpassword'])) {
                    $auth = new User($this->db);
                    $currentPassword = $_POST['current-password'];
                    $newPassword = $_POST['new-password'];
                    $confirmPassword = $_POST['confirm-password'];
                    $userid = $_SESSION['user']['user_id'];
                
                    // Kiểm tra xem mật khẩu mới và mật khẩu nhập lại có giống nhau không
                    if ($newPassword !== $confirmPassword) {
                        echo '
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Mật khẩu nhập lại và mật khẩu mới không khớp nhau!",
                            showConfirmButton: false,
                            timer: 1500
                          });
                        </script>';
                    } else {
                        $data = [
                            'user_password' => $newPassword
                            
                        ];
                        // Thực hiện cập nhật mật khẩu
                        $result = $auth->updateProfile($userid, $data);
                
                        if ($result === true) {
                            // Mật khẩu đã được cập nhật thành công
                            echo '
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Cập nhật mật khẩu thành công !",
                                showConfirmButton: false,
                                timer: 1500
                              });
                            </script>';
                        } else {
                            echo '
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "Cập nhật mật khẩu không thành công !",
                                showConfirmButton: false,
                                timer: 1500
                              });
                            </script>';
                           
                        }
                    }
                }
                else {
                echo "Không có nút t1 nào được nhấn!";
            }
        }
        
        $this->includeFooter();
    }
    

}