<?php


namespace Src\Models;
use Src\Models\CrudOperations;


class Cart {
    private $crud;
    private $db;


    public function __construct() {
        $this->crud = new CrudOperations();
        $this->db = new DatabaseConnection(); 
    }
    public function addProductsInCart($data){
        return $this->crud->add('cart', $data) ;
    }
    public function deleteProductOutCart($userId,$id ){
                // Tạo câu truy vấn DELETE với điều kiện WHERE kết hợp giữa user_id và product_id
            $query = "DELETE FROM cart WHERE user_id = $userId AND product_id = $id";

            // Thực thi câu truy vấn
            if ($this->db->conn->query($query)) {
                return true; // Trả về true nếu xóa thành công
            } else {
                return false; // Trả về false nếu có lỗi xảy ra
            }
        
    }
    public function getCartById($id){
        return $this->crud->getById('cart','product_id',$id) ;
        
    }
    public function getProductsOutCart($id){
        $query = "SELECT 
        p.*, 
        pi.image_path,
        c.quantity,
        c.size
      FROM 
        cart c
      JOIN 
        products p ON c.product_id = p.product_id
      LEFT JOIN 
        (
          SELECT 
            product_id, 
            MIN(image_path) AS image_path 
          FROM 
            product_images 
          GROUP BY 
            product_id 
        ) pi ON p.product_id = pi.product_id
      WHERE 
        c.user_id = $id";

$result = $this->db->conn->query($query);
$data = [];
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
}

return $data;
    }
}