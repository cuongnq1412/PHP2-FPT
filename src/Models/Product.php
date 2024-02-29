<?php

// src/Models/Post.php

namespace Src\Models;
use Src\Models\CrudOperations;


class Product {
    
    private $crud;
    private $db;

    public function __construct() {
        $this->crud = new CrudOperations();
        $this->db = new DatabaseConnection(); 
    }

    
    // public function addProduct($data) {
    //     $productId = $this->crud->add('products', $data);
    //     return $productId;
    // }
    public function addProduct($data,$files) {
        return $this->crud->addwithfileProduct('products', $data,$files);
    }
   
    public function updateProduct($id,$data,$file) {
        return $this->crud->updateProduct('products', $id, $data, $file) ;
    } 
    public function getProductById($id) {
        return $this->crud->getById('products','product_id',$id) ;
    }
    public function deleteProductById($id) {
        return $this->crud->delete('products','product_id', $id) ;
    }

    public function getAllProduct(){
      
            $query =  " SELECT 
                        p.*, 
                        pi.image_path, 
                        c.category_name 
                    FROM 
                        products p
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
                    LEFT JOIN 
                        categories c ON p.category_id = c.category_id";
            $result = $this->db->conn->query($query);
            $data = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
    
            return $data;
        
    }
    public function getByImgProduct($id){
        $query = "SELECT * FROM product_images WHERE product_id = $id";
    $result = $this->db->conn->query($query);

    $images = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image_path']; // Chỉ lấy đường dẫn của ảnh
        }
    }

    return $images;
    }
    public function addCategory($data) {
        return $this->crud->add('categories', $data);
    }
    public function getAllCategory() {
        return $this->crud->getAll('categories');
    }
    public function getCategoryById($id){
        return $this->crud->getById('categories','category_id', $id) ;

    }
    public function deleteCategoryById($id) {
        return $this->crud->delete('categories','category_id', $id) ;
    }
    public function updateCategory($id,$data) {
        return $this->crud->update('categories', $id,'category_id', $data) ;
    } 
  
  
 
  }