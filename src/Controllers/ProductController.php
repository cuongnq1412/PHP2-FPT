<?php

namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\Product;
use Src\Models\Home;

class ProductController
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
        
        $categoryModel = new Product($this->db);
            $data = $categoryModel->getAllCategory();
        include('./src/Views/admin/product/add_product.php');
        $this->includeFooter();
        
    }
    // người dùng 
    public function renderProductsController(){
        global $url;
        
        include(__DIR__ . '/../Views/inc/header.php');

        $productModel = new Product($this->db);
        $data = $productModel->getAllProduct();
        include('./src/Views/shop.php');
        include(__DIR__ . '/../Views/inc/footer.php');

        
       
    }
    
    public function renderByIdProductController($id){
        global $url;
        include(__DIR__ . '/../Views/inc/header.php');
         
        $productModel = new Product($this->db);
        $data = $productModel->getAllProduct();
        $product = $productModel->getProductById($id);
        $images =$productModel->getByImgProduct($id);

        include('./src/Views/sproduct.php');

        include(__DIR__ . '/../Views/inc/footer.php');

       
    }

    //admin

    public function addProductController(){
        // Kiểm tra xem dữ liệu từ form đã được gửi hay chưa
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem có đủ dữ liệu từ form không
            if (
                isset($_POST['product_name']) && 
                isset($_POST['price']) && 
                isset($_POST['stock_quantity']) && 
                isset($_POST['category']) && 
                isset($_POST['manufacturer']) && 
                isset($_POST['description']) && 
                isset($_POST['product_details']) && 
                isset($_FILES['product_photo'])
            ) {
                // Lấy dữ liệu từ form
                $product_name = $_POST['product_name'];
                $price = $_POST['price'];
                $stock_quantity = $_POST['stock_quantity'];
                $category = $_POST['category'];
                $manufacturer = $_POST['manufacturer'];
                $description = $_POST['description'];
                $product_details = $_POST['product_details'];
                $imgproducts = $_FILES['product_photo'];
    
             
                $productModel = new Product($this->db);
                
                
                $data = [
                    'product_name' => $product_name,
                    'description' => $description,
                    'price' => $price,
                    'stock_quantity' => $stock_quantity,
                    'category_id' => $category,
                    'manufacturer' => $manufacturer,
                    'product_details' => $product_details
                ];
                
               
                $success = $productModel->addProduct($data,$imgproducts);
             
                
             // Kiểm tra và xử lý ảnh sản phẩm
                    if ($success) {
                       
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                          Swal.fire({
                            title: "Sản phẩm đã được thêm thành công!",
                            icon: "success"
                          }).then((result) => {
                            if (result.isConfirmed) {
                              window.location.href = "'.BASE_URL.'/admin/addproduct";
                            }
                          });
                        </script>';
                  

                        // echo $product_id;
                        exit(); 
                    } else {
                        // Hiển thị thông báo khi có lỗi xảy ra khi thêm sản phẩm
                        echo "Có lỗi xảy ra khi thêm sản phẩm!";
                    }

            }
        }
    }
    public function updateProductController(){
        // Kiểm tra xem dữ liệu từ form đã được gửi hay chưa
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem có đủ dữ liệu từ form không
            if (
                isset($_POST['product_id']) &&
                isset($_POST['product_name']) && 
                isset($_POST['price']) && 
                isset($_POST['stock_quantity']) && 
                isset($_POST['category']) && 
                isset($_POST['manufacturer']) && 
                isset($_POST['description']) && 
                isset($_POST['product_details'])
            ) {
                // Lấy dữ liệu từ form
                $product_id = $_POST['product_id'];
                $product_name = $_POST['product_name'];
                $price = $_POST['price'];
                $stock_quantity = $_POST['stock_quantity'];
                $category = $_POST['category'];
                $manufacturer = $_POST['manufacturer'];
                $description = $_POST['description'];
                $product_details = $_POST['product_details'];
                $imgproducts = $_FILES['product_photo'];
                // Kiểm tra và xử lý ảnh sản phẩm (nếu có)
    
                // Khởi tạo một instance của lớp Product
                $productModel = new Product($this->db);
    
                // Dữ liệu để cập nhật vào cơ sở dữ liệu
                $data = [
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'description' => $description,
                    'price' => $price,
                    'stock_quantity' => $stock_quantity,
                    'category_id' => $category,
                    'manufacturer' => $manufacturer,
                    'product_details' => $product_details
                ];
    
                // Gọi phương thức update từ model để cập nhật sản phẩm
                $success = $productModel->updateProduct($product_id,$data,$imgproducts);
    
                if ($success) {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                      Swal.fire({
                        title: "Sản phẩm đã được sửa thành công!",
                        icon: "success"
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "'.BASE_URL.'/admin/listproducts";
                        }
                      });
                    </script>';
              
                    exit(); 
                } else {
                    // Hiển thị thông báo khi có lỗi xảy ra khi cập nhật sản phẩm
                    echo "Có lỗi xảy ra khi cập nhật sản phẩm!";
                }
            }
        }
    }
    
    
    public function getProductByIdController($id){
          
          if (!empty($id)) {
           
            $productModel = new Product($this->db);
            // Gọi phương thức để lấy thông tin product theo ID từ model
            $product = $productModel->getProductById($id);
            // Kiểm tra xem product có tồn tại hay không
            if ($product) {
                $this->includeHeader();
             

                 $categories = $productModel->getAllCategory();
                 $images =$productModel->getByImgProduct($id);

                // Trả về thông tin product để sử dụng trong view hoặc xử lý tiếp
                include('./src/Views/admin/product/update_product.php');
                 $this->includeFooter();

            } else {
                // Nếu không tìm thấy product, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
                echo "Không tìm thấy product với ID này!";
                return null;
            }
        } else {
            // Nếu không có ID user, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
            echo "Không có ID user được cung cấp!";
            return null;
        }
    }

    public function category(){
            $this->includeHeader();
            $categoryModel = new Product($this->db);
            $data = $categoryModel->getAllCategory();

            include('./src/Views/admin/product/add_category.php');
            $this->includeFooter();
             
          

    }
    
    public function getAllProductController(){
        $this->includeHeader();
        $productModel = new Product($this->db);
        $data = $productModel->getAllProduct();

        include('./src/Views/admin/product/list_product.php');
        $this->includeFooter();
         
      

}
    public function themdanhmuc()
    {
           // Kiểm tra xem dữ liệu từ form đã được gửi hay chưa
           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
            if (isset($_POST['category'])) {
                // Lấy dữ liệu từ form
                $category = $_POST['category'];
               

                // Khởi tạo một instance của lớp Post
                $categoryModel = new Product($this->db);

                // Dữ liệu để thêm vào cơ sở dữ liệu
                $data = [
                    'category_name' => $category
                
                ];

                // Gọi phương thức add từ model để thêm Danh mục
                $success = $categoryModel->addCategory($data);

                // Kiểm tra xem việc thêm Danh mục có thành công hay không và thực hiện hành động phù hợp
                if ($success) {
                    // Nếu thành công, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                      Swal.fire({
                        title: "Danh mục đã được thêm thành công!",
                        icon: "success"
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "'.BASE_URL.'/admin/addcategory";
                        }
                      });
                    </script>';
            
                    // Chuyển hướng người dùng tới trang khác sau khi thêmdanh muc thành công
                    exit(); 

                } else {
                    // Nếu không thành công, bạn có thể hiển thị thông báo lỗi
                    echo "Có lỗi xảy ra khi thêm Danh mục!";
                }
            }}
    }
    
    public function deleteCategoryController($id){
           // Kiểm tra xem người dùng có tồn tại trong CSDL hay không
           $categoryModel = new Product($this->db);
           $category = $categoryModel->getCategoryById($id);
           if ($category) {
             
               $deleted = $categoryModel->deleteCategoryById($id);
               if ($deleted) {
                   // Nếu xóa thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                   echo '
                   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                      <script>
                      Swal.fire({
                       position: "center",
                       icon: "success",
                       title: "xóa danh mục thành công !",
                       showConfirmButton: false,
                       timer: 1500
                     });</script>';
                
                   // Chuyển hướng người dùng tới trang khác sau khi thêm danh mục thành công
                   header("Location: /PHP2_MVC/admin/addcategory");
                   exit();
               } else {
                   // Nếu không xóa được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                   echo "Đã xảy ra lỗi khi xóa danh mục!";
               }
           } else {
               // Nếu không tìm thấy danh mục, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
               echo "Không tìm thấy danh mục với ID này!";
           }
     
   
    }
    public function updateCategoryController(){
       // Kiểm tra xem có dữ liệu gửi đi từ form không
       if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kiểm tra xem các trường cần thiết đã được gửi hay không
        if (isset($_POST['categoryid']) && isset($_POST['category'])) {
            // Lấy thông tin danh mục từ form
            $category_id = $_POST['categoryid'];
            $category_name = $_POST['category'];

            // Kiểm tra xem danh mục có tồn tại trong CSDL hay không
            $categoryModel = new Product($this->db);
            $category = $categoryModel->getCategoryById($category_id);
            // Dữ liệu để thêm vào cơ sở dữ liệu
                $data = [
                    'category_name' => $category_name
                   
                ];
            if ($category) {
                // Thực hiện cập nhật danh mục trong CSDL
                $updated = $categoryModel->updateCategory($category_id,$data);
                if ($updated) {
                    // Nếu cập nhật thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                      Swal.fire({
                        title: "Danh mục đã được cập nhật thành công!",
                        icon: "success"
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = "'.BASE_URL.'/admin/addcategory";
                        }
                      });
                    </script>';
                } else {
                    // Nếu không cập nhật được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                    echo "Đã xảy ra lỗi khi cập nhật danh mục!";
                }
            } else {
                // Nếu không tìm thấy danh mục, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                echo "Không tìm thấy danh mục với ID này!";
            }
        } else {
            // Nếu không đủ dữ liệu cần thiết, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
            echo "Không đủ dữ liệu để cập nhật danh mục!";
        }
    }
    }
    public function getCategoryByIdController($id) 
    {  
        // Kiểm tra xem ID danh mục đã được cung cấp hay không
        if (!empty($id)) {
            // Khởi tạo một instance của lớp Post
            $categoryModel = new Product($this->db);
            // Gọi phương thức để lấy thông tin danh mục theo ID từ model
            $category = $categoryModel->getCategoryById($id);
            // Kiểm tra xem danh mục có tồn tại hay không
            if ($category) {
                $this->includeHeader();
                // Trả về thông tin danh mục để sử dụng trong view hoặc xử lý tiếp
                $categoryModel = new Product($this->db);
                $data = $categoryModel->getAllCategory();
                include('./src/Views/admin/product/update_category.php');
                 $this->includeFooter();
                

            } else {
                // Nếu không tìm thấy danh mục, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
                echo "Không tìm thấy danh muc với ID này!";
                return null;
            }
        } else {
            // Nếu không có ID danh mục, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, chuyển hướng, vv.
            echo "Không có ID danh muc được cung cấp!";
            return null;
        }
          


    }
    public function deleteProductController($id){
           $productModel = new Product($this->db);
           $product = $productModel->getProductById($id);
           if ($product) {
             
               $deleted = $productModel->deleteProductById($id);
               if ($deleted) {
                   // Nếu xóa thành công, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo thành công, chuyển hướng, vv.
                   echo '
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                   <script>
                   Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "xóa sản phẩm thành công !",
                    showConfirmButton: false,
                    timer: 1500
                  });</script>';

                
                   // Chuyển hướng người dùng tới trang khác sau khi thêm danh mục thành công
                   header("Location: /PHP2_MVC/admin/listproducts");
                   exit();
               } else {
                   // Nếu không xóa được, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
                   echo "Đã xảy ra lỗi khi xóa danh mục!";
               }
           } else {
               // Nếu không tìm thấy danh mục, bạn có thể xử lý theo ý định của mình, ví dụ: thông báo lỗi, vv.
               echo "Không tìm thấy danh mục với ID này!";
           }
     
    }
    }