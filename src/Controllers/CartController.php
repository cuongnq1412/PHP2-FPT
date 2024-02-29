<?php
namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\Cart;

class CartController {
    private $db; // Biến kết nối cơ sở dữ liệu

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }
    

    public function addProductInCartController(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
            if (isset($_POST['product_id'])
                && isset($_POST['user_id'])
                && isset($_POST['size'])
                && isset($_POST['quantity'])
            
                ) {
                // Lấy dữ liệu từ form
                $product_id = $_POST['product_id'];
                $user_id = $_POST['user_id'];
                $size = $_POST['size'];
                $quantity = $_POST['quantity'];
               
                $cartModel = new Cart($this->db);
                $data = [
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'size ' => $size,
                    'quantity ' => $quantity
                ];

                // Gọi phương thức add từ model để thêm Danh mục
                $success = $cartModel->addProductsInCart($data);

                
                if ($success) {
                   
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Đã thêm vào giỏ hàng !",
                        
                        showConfirmButton: false,
                        timer: 1500
                      });
                    </script>';
                    echo '<script>window.location.href = "'.BASE_URLC.'Sproduct/'.$product_id.'";</script>';
                    
                    
                    exit(); 

                } else {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: "Xãy ra sự cố !",
                        showConfirmButton: false,
                        timer: 1500
                      });
                    </script>';
                    echo '<script>window.location.href = "'.BASE_URLC.'Sproduct/'.$product_id.'";</script>';
                   
                }
            }}
    }
    public function deleteProductoutCartController($id){ // thay cho id của product chứ không lấy ở ủrl
        $cartModel = new Cart($this->db);
        $cart = $cartModel->getcartById($id);
        if ($cart) {
          
            $deleted = $cartModel->deleteProductoutCart($id);
            if ($deleted) {
               echo
                exit();
            } else {
               
                echo "Đã xảy ra lỗi khi xóa danh mục!";
            }
        } else {
            // Nếu không tìm thấy danh mục, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
            echo "Không tìm thấy danh mục với ID này!";
        }
  
    }
    public function renderCartController($id){
        
        include(__DIR__ . '/../Views/inc/header.php');
        $cartModel = new Cart($this->db);
        $data = $cartModel->getProductsOutCart($id);
        
        include('./src/Views/cart.php');
        unset($_SESSION['selected_products']);
        include(__DIR__ . '/../Views/inc/footer.php');
    }
    public function DeleteProductsOutCartController ($id){
             
                $cartModel = new Cart($this->db);
                $cart = $cartModel->getCartById($id);
                if ($cart) {
                  
                    $deleted = $cartModel->deleteProductOutCart($_SESSION['user']['user_id'],$id);
                    if ($deleted) {
                        
                        echo '<script>window.location.href = "'.BASE_URLC.'Cart/'.$_SESSION['user']['user_id'].'";</script>';
                        
                    } else {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: "Xãy ra sự cố !",
                        showConfirmButton: false,
                        timer: 1500
                      });
                    </script>';
                    echo '<script>window.location.href = "'.BASE_URLC.'Cart/'.$_SESSION['user']['user_id'].'";</script>';
                    }
                } else {
                    // Nếu không tìm thấy bài viết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "warning",
                        title: " Không tìm thấy sản phẩm ở cart !",
                        showConfirmButton: false,
                        timer: 1500
                      });
                    </script>';
                    echo '<script>window.location.href = "'.BASE_URLC.'Cart/'.$_SESSION['user']['user_id'].'";</script>';
                }
        
    }
    public function SaveProductCheckSS() {
       
    
        if (isset($_POST['checkout'])) {
            if (!isset($_SESSION['selected_products'])) {
                $_SESSION['selected_products'] = array();
            }
    
            if (isset($_POST['selectedProducts']) && is_array($_POST['selectedProducts'])) {
                foreach ($_POST['selectedProducts'] as $productId => $productData) {
                    // Lấy thông tin sản phẩm từ dữ liệu POST
                    $id = $productId;
                    $name = $productData['name'];
                    $price = $productData['price'];
                    $quantity = $productData['quantity'];
    
                    // Lưu thông tin sản phẩm vào session 'selected_products'
                    $_SESSION['selected_products'][$id] = array(
                        'id' => $id,
                        'name' => $name,
                        'price' => $price,
                        'quantity' => $quantity
                    );
                }
            }
            
            // In ra dữ liệu trong session 'selected_products' để kiểm tra
            echo "Dữ liệu trong session 'selected_products': <br>";
            print_r($_SESSION['selected_products']);
            
            // Chuyển hướng người dùng đến trang thanh toán
            // header("Location: ".BASE_URLC."Payment/".$_SESSION["user"]["user_id"]."");
            exit;
        }
    }
    
    
}