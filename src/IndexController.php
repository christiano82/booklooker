<?php
namespace App\lf8;
// use App\lf8\AbstractController;
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