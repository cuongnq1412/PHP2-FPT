<?php


namespace Src\Models;
use Src\Models\CrudOperations;


class Payment {
    private $crud;
    private $db;


    public function __construct() {
        $this->crud = new CrudOperations();
        $this->db = new DatabaseConnection(); 
    }
}