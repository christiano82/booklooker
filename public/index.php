<?php
require __DIR__ . '/../vendor/autoload.php';
require_once('../src/config.php');
use App\lf8\Router;
// use App\lf8\db\BaseDatabase;
// require_once('../src/Router.php');
$router=new Router();
$router->route($config);
// $router->routeStatic($config);
// phpinfo();
// $db = new BaseDatabase($config['db']);
// $db->query('select * from buecher');
// var_dump($db->fetchAssoc());
// $db->query("select count(*) from buecher");
// var_dump($db->fetchAssoc());

// foreach($db->getTableNames() as $table) 
// {
//   var_dump($db->getPrimaryKey($table));
// }


// var_dump($db->readTable('buecher'));
?>