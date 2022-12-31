<?php
namespace App\lf8\controllers;

use App\lf8\AbstractCrudController;
use App\lf8\models\LibraryDatabaseModel;
class LibraryController extends AbstractCrudController
{
    private $_dbModel;

    function __construct($config)
    {
        parent::__construct($config);
        $this->_dbModel = new LibraryDatabaseModel($this->_config);
    }
    function create()
    {
    }
    function read()
    {
        switch($this->getRequestMethod())
        {
            case 'GET':
                $this->default();
            case 'POST':
                $this->readEntry();
        }
    }
    function update() 
    {
        return $this->default();
    }
    function delete() 
    {
        return $this->default();
    }
    function default() 
    {
        $books = $this->_dbModel->readBookSelect();
        $currentId = count($books) > 0 ? $books[0]['buecher_id']:0;
        echo $this->render('library.html.twig',['nav'=>$this->_nav,'template'=>'','books'=>$books,'currentId'=>$currentId]);
    }
    function readTables(array $tblNames) : array 
    {
        return $this->_dbModel->readTables($tblNames);
    }
    function getTableNames() : array 
    {
        return $this->_dbModel->getTableNames();
    }
    function readEntry() 
    {
        $books = $this->_dbModel->readBookSelect();
        $currentId = $this->getPost('bookSelect');
        $entry = $this->_dbModel->getBookEntry($currentId);
        echo $this->render('library.html.twig',['nav'=>$this->_nav,'template'=>'library/form-read.html.twig',
        'entry'=>$entry,'books'=>$books,'currentId'=>$currentId]);
    }
}
?>