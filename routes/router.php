<?php

use Src\Models\DatabaseConnection;

use Src\Controllers\CartController;

use Src\Controllers\PostController;
use Src\Controllers\UserController;

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
        '/admin/addpost' => 'index',
        '/admin/updatepost/'.$id.'' => 'getPostByIdController',
        '/admin/deletepost/'.$id.'' => 'deletePostController',
        '/admin/editcategory/'.$id.'' => 'editCategory',
        '/admin/editproduct/'.$id.'' => 'editProduct',
        '/admin/adduser' => 'index'
    ],
    'POST' => [
        //post
        '/admin/addpost' => 'addPostController',
        '/admin/updatepost/'.$id.'' => 'updatePostController',

        '/admin/adduser' => 'addUserController',
        '/admin/updatecategory/'.$id.'' => 'updateCategoryController',
        '/admin/updateproduct/'.$id.'' => 'updateProductController'
    ]
];
echo $id;
// echo '/admin/updatepost/'.$id.'<br>';
echo $requestUri .'<br>';
// Kiểm tra xem route có tồn tại không
if (isset($routes[$method]) && isset($routes[$method][$requestUri])) {
    $action = $routes[$method][$requestUri];
    $dbConnection = new DatabaseConnection();
        
    // Tạo controller dựa trên route và action
    if ($requestUri === '/admin/addpost') {
        $controller = new PostController($dbConnection);
    } elseif ($requestUri === ('/admin/updatepost/'.$id.'')) {
        $controller = new PostController($dbConnection);
    }elseif ($requestUri === ('/admin/deletepost/'.$id.'')) {
        $controller = new PostController($dbConnection);}
        
        // Đặt action là 'updatePostController'
        // $id = end($parts);
    // } elseif (preg_match('#^/admin/editcategory/(\d+)$#', $requestUri, $matches)) {
    //     $controller = new CategoryController($dbConnection);
    //     $action = 'editCategory'; // Đặt action là 'editCategory'
    //     $id = $matches[1]; // Trích xuất ID từ URI
    // } elseif (preg_match('#^/admin/editproduct/(\d+)$#', $requestUri, $matches)) {
    //     $controller = new ProductController($dbConnection);
    //     $action = 'editProduct'; // Đặt action là 'editProduct'
    //     $id = $matches[1]; // Trích xuất ID từ URI
    // } elseif ($requestUri === '/admin/adduser') {
    //     $controller = new UserController($dbConnection);
    // }

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
    }
} else {
    http_response_code(404);
    echo "Route không tồn tại ";
}
?>