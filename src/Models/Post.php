<?php

// src/Models/Post.php

namespace Src\Models;
use Src\Models\CrudOperations;


class Post {
    private $crud;

    public function __construct() {
        $this->crud = new CrudOperations();
    }
    public function addPost($data) {
        return $this->crud->add('post', $data);
    }
    public function updatePost($id,$data) {
        return $this->crud->update('post', $id, $data) ;
    } 
    public function getPostById($id) {
        return $this->crud->getById('post', $id) ;
    }
    public function deletePostById($id) {
        return $this->crud->delete('post', $id) ;
    }
   
  }