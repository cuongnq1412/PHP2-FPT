<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Src\Models\DatabaseConnection;

use Src\Controllers\CartController;

use Src\Controllers\HomeController;
use Src\Controllers\PostController;
use Src\Controllers\ProductController;
use Src\Controllers\UserController;
use Src\Controllers\PaymentController;

// Autoload classes
// require_once '../vendor/autoload.php';

// Thư mục gốc
$rootDirectory = '/PHP2_MVC';

$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Loại bỏ phần thư mục gốc từ URI
$requestUri = str_replace($rootDirectory, '', $requestUri);
$parts = explode('/', $requestUri);
$idend = end($parts);
if (is_numeric($idend)) {
   $id=$idend;
} else {
   $id=null;
}

// Thiết lập một mảng các route
$routes = [
    'GET' => [
        '/' => 'index',
        //người dùng
        '/Home' => 'index',
        '/Logout' => 'logout',
        '/Shop' => 'renderProductsController',
        '/Sproduct/'.$id.'' => 'renderByIdProductController',
        '/Blog' => 'renderPostsController',
        '/Cart/'.$id.'' => 'renderCartController',
        '/Payment/'.$id.'' => 'renderPaymentController',
        
        '/DeleteProductOutCart/'.$id.'' => 'DeleteProductsOutCartController',
        //admin
        '/admin/addpost' => 'index',
        '/admin/profile/'.$id.'' => 'getProfileController',
        '/admin/updatepost/'.$id.'' => 'getPostByIdController',
        '/admin/deleteuser/'.$id.'' => 'deleteUserController',
        '/admin/listuser' => 'getAllUserController',
        '/admin/deletepost/'.$id.'' => 'deletePostController',
        '/admin/listpost' => 'getAllPostController',
        '/admin/editcategory/'.$id.'' => 'editCategory',
        
        // user
        '/Register' => 'renderRegister',
        '/login' => 'renderLogin',
        '/About' => 'renderAboutController',
        '/Contact' => 'renderContactController',
        '/updateuser/'.$id.'' => 'getUserByIdController',
        //prodcut
        '/admin/addproduct' => 'index',
        '/admin/addcategory' => 'category',
        '/admin/deletecategory/'.$id.'' => 'deleteCategoryController',
        '/admin/updatecategory/'.$id.'' => 'getCategoryByIdController',
        '/admin/listproducts' => 'getAllProductController',
        '/admin/updateproduct/'.$id.'' => 'getProductByIdController',
        '/admin/deleteproduct/'.$id.''=>'deleteProductController'




        



    ],
    'POST' => [
        //người dùng
        '/Sproduct/'.$id.'' => 'addProductInCartController',
        '/admin/profile/'.$id.'' => 'getProfileController',
        '/Cart/'.$id.'' => 'SaveProductCheckSS',

        
        //post
        '/admin/addpost' => 'addPostController',
        '/admin/updatepost/'.$id.'' => 'updatePostController',

        '/admin/updatecategory/'.$id.'' => 'updateCategoryController',
        '/admin/updateproduct/'.$id.'' => 'updateProductController',
        // user
        '/register' => 'addUserController',
        '/login' => 'loginController',

        '/updateuser/'.$id.'' => 'updateUserController',
        //product
        '/admin/addproduct' => 'addProductController',
        '/admin/addcategory' => 'themdanhmuc',
        '/admin/updateproduct/'.$id.''=>'updateProductController'
        





    ]
];
echo '<input type="hidden" vlaue="qc">';
// Kiểm tra xem route có tồn tại không
if (isset($routes[$method]) && isset($routes[$method][$requestUri])) {
    $action = $routes[$method][$requestUri];
    $dbConnection = new DatabaseConnection();
        
    // Tạo controller dựa trên route và action
    if ($requestUri === ('/Home') || $requestUri ===( '/')) { //người dùng
        $controller = new HomeController($dbConnection);
    } elseif ($requestUri === ('/Shop')) {
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/Sproduct/'.$id.'')) {
        if ($method === 'GET') {
            $controller = new ProductController($dbConnection);
        } elseif ($method === 'POST') {
            $controller = new CartController($dbConnection);
        }
    }elseif ($requestUri === ('/Logout')) {
        $controller = new HomeController($dbConnection);
    }elseif ($requestUri === ('/Cart/'.$id.'')) {
        $controller = new CartController($dbConnection);
    }elseif ($requestUri === ('/Payment/'.$id.'')) {
        $controller = new PaymentController($dbConnection);
    }elseif ($requestUri === ('/DeleteProductOutCart/'.$id.'')) {
        $controller = new CartController($dbConnection);
    }elseif ($requestUri === ('/Blog')) {
        $controller = new PostController($dbConnection);
    }elseif ($requestUri === ('/About')) {
        $controller = new HomeController($dbConnection);
    }elseif ($requestUri === ('/Contact')) {
        $controller = new HomeController($dbConnection);
    }elseif ($requestUri === ('/admin/profile/'.$id.'')) {
        $controller = new UserController($dbConnection);
    }elseif ($requestUri === ('/admin/listuser')) {
        $controller = new UserController($dbConnection);
    }elseif ($requestUri === ('/admin/addpost')) {
        $controller = new PostController($dbConnection);
    }elseif ($requestUri === ('/admin/updatepost/'.$id.'')) {
        $controller = new PostController($dbConnection);
    }elseif ($requestUri === ('/admin/listpost')) {
        $controller = new PostController($dbConnection);
    }elseif ($requestUri === ('/admin/deletepost/'.$id.'')) {
        $controller = new PostController($dbConnection);
    }elseif ($requestUri === ('/Register')) {  //user
        $controller = new UserController($dbConnection);
    }elseif ($requestUri === ('/login')) {  //user
        $controller = new UserController($dbConnection);
    }elseif ($requestUri === ('/updateuser/'.$id.'')) {
        $controller = new UserController($dbConnection);
    }elseif ($requestUri === ('/admin/deleteuser/'.$id.'')) { 
        $controller = new UserController($dbConnection);
    }elseif ($requestUri === ('/admin/addproduct')) {   //product
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/admin/addcategory')) {   //product
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/admin/deletecategory/'.$id.'')) {   //product
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/admin/updatecategory/'.$id.'')) {   //product
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/admin/listproducts')) {   //product
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/admin/updateproduct/'.$id.'')) {   //product
        $controller = new ProductController($dbConnection);
    }elseif ($requestUri === ('/admin/deleteproduct/'.$id.'')) {   //product
        $controller = new ProductController($dbConnection);
    }
        
        
       

    // Kiểm tra xem action có tồn tại trong controller không
    if (isset($controller) && method_exists($controller, $action)) {
        // Truyền ID vào action nếu có
        if ($id !== null) {
            $controller->$action($id);
        } else {
            $controller->$action();
        }
    } else {
        http_response_code(404);
        echo "Action không tồn tại";
        echo $action;
    }
} else {
    http_response_code(404);
    echo "Route không tồn tại ";
}
?>