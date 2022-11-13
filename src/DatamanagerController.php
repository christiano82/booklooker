<?php
namespace App\lf8;

class DatamanagerController extends AbstractCrudController 
{

    function create() {}
    function read() 
    {
        $tblid=$this->getGet('tblid');
        if($tblid == 'buecher') {
            echo parent::render('datamanager.html.twig',['nav'=>$this->_nav,'template'=>'datamanager/buecher/form-read.html.twig']);
        }
    }
    function update() {}
    function delete() {}
    function default() 
    {
        echo parent::render('datamanager.html.twig',['nav'=>$this->_nav,'template'=>'']);
    }
}
?>