<?php
namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\Home;
use Src\Models\Product;

class HomeController
{
    private $db; // Biến kết nối cơ sở dữ liệu

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }
    
  
    public function index(){
        // $homeModel = new Home($this->db);
        // $check= $homeModel->isUserLoggedIn();
        // if($check){
        include(__DIR__ . '/../Views/inc/header.php');
        $productModel = new Product($this->db);
        $data = $productModel->getAllProduct();
        
        include('./src/Views/home.php');
        include(__DIR__ . '/../Views/inc/footer.php');

        
        // }else{
        //     header('Location: login'); 
        // }
    }
    public function logout(){
       
            session_start();

           
            unset($_SESSION['user']);

            
            session_unset();
            session_destroy();

            
            header("Location: Home"); 
            exit();
    }
    public function renderAboutController(){
        include(__DIR__ . '/../Views/inc/header.php');
        include('./src/Views/about.php');
        include(__DIR__ . '/../Views/inc/footer.php');
    }
    public function renderContactController(){
        include(__DIR__ . '/../Views/inc/header.php');
        include('./src/Views/contact.php');
        include(__DIR__ . '/../Views/inc/footer.php');
    }
    }