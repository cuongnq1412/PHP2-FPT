<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('BASE_URL', '/PHP2_MVC');
define('BASE_URLC', 'http://localhost/PHP2_MVC/');

$url='http://localhost/PHP2_MVC/';
require_once './vendor/autoload.php';
require_once './routes/router.php';
// include './src/Models/DatabaseConnection.php';

?>
<link rel="stylesheet" href="./public/css/style.css">