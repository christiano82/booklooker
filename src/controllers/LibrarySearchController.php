<?php
namespace App\lf8\controllers;

use App\lf8\AbstractCrudController;
use App\lf8\models\LibrarySearchDatabaseModel;
use Exception;

class LibrarySearchController extends AbstractCrudController
{

    private $_dbModel;

    function __construct($config)
    {
        parent::__construct($config);
        try {
            $this->_dbModel = new LibrarySearchDatabaseModel($this->_config);
        } catch(Exception $e) {
            $this->renderMessage("Fehler bei der Datenbankanbindung $e","/public/LibrarySearch");
            die();
        }
     }
    function create()
    {
        $selectCommand = $this->getPost('selectCommand');
        $stmt = 'SELECT '. $selectCommand;
        if(empty($selectCommand )) 
        {
            return $this->default();
        }
        $tables = $this->_dbModel->readCustomSelect($stmt);
        echo $this->render('librarySearch.html.twig',[
            'nav'=>$this->_nav,
            'tables' => $tables,
            'stmt' => $selectCommand,
            'template'=>'library/librarySearch.table.html.twig']);
    }
    function read()
    {
        $view = $this->getGet('view');
        if($view == 'all') 
        {
            // 1. Tablenames
            $tableNames =$this->getTableNames();
            $tables = $this->readTables($tableNames);
            echo $this->render('librarySearch.html.twig',[
                'nav'=>$this->_nav,
                'tables' => $tables,
                'template'=>'library/librarySearch.table.html.twig']);
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
        echo $this->render('librarySearch.html.twig',['nav'=>$this->_nav,'template'=>'']);
    }
    function readTables(array $tblNames) : array 
    {
        return $this->_dbModel->readTables($tblNames);
    }
    function getTableNames() : array 
    {
        return $this->_dbModel->getTableNames();
    }
    function renderMessage($message,$returnUrl) 
    {
        echo $this->render('librarySearch.html.twig',['nav'=>$this->_nav,
        'returnUrl'=>$returnUrl,'message'=> $message,'template'=>'library/message.html.twig']);
    }
}
?>