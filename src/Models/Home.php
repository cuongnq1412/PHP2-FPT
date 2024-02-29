<?php

// src/Models/Post.php

namespace Src\Models;
use Src\Models\CrudOperations;


class Home {
    // private $crud;
    private $db;

    public function __construct() {
        // $this->crud = new CrudOperations();
        $this->db = new DatabaseConnection(); 
    }
    
    public  function isUserLoggedIn() {
      
        if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            // Session 'user' đã được thiết lập và chứa thông tin đăng nhập
            return true;
        } else {
            // Session 'user' không được thiết lập hoặc không chứa thông tin đăng nhập
            return false;
        }
    }

}