<?php
require __DIR__ . '/../vendor/autoload.php';
require_once('../src/config.php');
use App\lf8\Router;
// require_once('../src/Router.php');
$router=new Router();
//$router->route();
$router->routeStatic($config);
// phpinfo();

?>