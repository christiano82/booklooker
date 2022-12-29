<?php

namespace App\lf8;

$db=[
    'user' => 'root',
    'name' => 'buchladen',
    'port' => 3306,
    'password' => '',
    'host' => 'localhost',
    'sql.dump' => 'buchladen.sql'
];

$settings= [
    'pk.edit'=>true
];

$nav = [
    ['href'=> 'Index','caption'=>'Home'],
    ['href'=> 'LibrarySearch','caption'=>'Suche'],
    ['href'=> 'Datamanager', 'caption' => 'Datenbank'],
    ['href'=> 'Library','caption' => 'Bücher']
];

$routes = [
    '/' => 'IndexController',
    'index' => 'IndexController',
    'library' => 'LibraryController',
    'datamanager' => 'DatamanagerController'
];

$config = [
    'db' => $db,
    'nav' => $nav,
    'routes' => $routes,
    'settings'=>$settings
];


?>