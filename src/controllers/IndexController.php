<?php
namespace App\lf8\controllers;

use App\lf8\AbstractViewController;
// require __DIR__ .'/AbstractController.php';

class IndexController extends AbstractViewController 
{
    function view() 
    {
        $this->default();
    }
    function default()
    {
        echo $this->render('index.html.twig',['nav'=>$this->_nav]);
    }
}
?>