<?php
require __DIR__ . '/../vendor/autoload.php';
require_once('../src/config.php');
use App\lf8\Router;

$router=new Router();
$router->route($config);

?>