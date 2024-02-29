<?php

// src/Models/Post.php

namespace Src\Models;
use Src\Models\CrudOperations;


class Post {
    private $crud;

    public function __construct() {
        $this->crud = new CrudOperations();
    }
    public function addPost($data,$file) {
        return $this->crud->addwithfile('post', $data,'post_id', $file,'thumbnail');
       
    }
    public function updatePost($id,$data,$file) {
        return $this->crud->updateWithImage('post','post_id', $id, $data, $file);
    } 
    public function getPostAll() {
        return $this->crud->getAll('post') ;
    }
    public function getPostById($id) {
        return $this->crud->getById('post', 'post_id',$id) ;
    }
    public function deletePostById($id) {
        return $this->crud->delete('post','post_id', $id) ;
    }
   
  }