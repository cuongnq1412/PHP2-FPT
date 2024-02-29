<?php
namespace Src\Controllers;

use Src\Models\DatabaseConnection;
use Src\Models\Payment;

class PaymentController {
    private $db; // Biến kết nối cơ sở dữ liệu

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }
    
    public function renderPaymentController(){
        include(__DIR__ . '/../Views/inc/header.php');
        include('./src/Views/payment.php');
        
        include(__DIR__ . '/../Views/inc/footer.php');
    }
}