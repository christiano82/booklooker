<?php

namespace App\lf8;

$db=[
    'user' => 'root',
    'name' => 'theDatabse',
    'passwort' => 'root'
];

$nav = [
    ['href'=> 'Index','caption'=>'Home'],
    ['href'=> 'Library','caption'=>'Library'],
    ['href'=> 'Datamanager', 'caption' => 'Datenbank']
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
    'routes' => $routes
];

// var_dump($config);

?>