<?php

// src/Models/Post.php

namespace Src\Models;
use Src\Models\CrudOperations;


class User {
    // private $db;

    // public function __construct($dbConnection) {
    //     $this->db = $dbConnection;
    // }
    private $crud;

    public function __construct() {
        $this->crud = new CrudOperations();
    }
    public function addPost($data) {
        return $this->crud->add('post', $data);
    }
    
    // public function addPost($table, $data) {
    //     $columns = implode(', ', array_keys($data));
    //     $values = "'" . implode("','", array_values($data)) . "'";
    //     $query = "INSERT INTO $table ($columns) VALUES ($values)";

    //     if ($this->db->query($query)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
  }