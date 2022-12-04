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
        $selectCommand = $this->getPost('selectCommand');
        $stmt = 'SELECT '. $selectCommand;
        if(empty($selectCommand )) 
        {
            return $this->default();
        }
        $tables = $this->_dbModel->readCustomSelect($stmt);
        echo $this->render('library.html.twig',[
            'nav'=>$this->_nav,
            'tables' => $tables,
            'stmt' => $selectCommand,
            'template'=>'library/library.table.html.twig']);
    }
    function read()
    {
        $view = $this->getGet('view');
        if($view == 'all') 
        {
            // 1. Tablenames
            $tableNames =$this->getTableNames();
            $tables = $this->readTables($tableNames);
            echo $this->render('library.html.twig',[
                'nav'=>$this->_nav,
                'tables' => $tables,
                'template'=>'library/library.table.html.twig']);
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
        echo $this->render('library.html.twig',['nav'=>$this->_nav,'template'=>'']);
    }
    function readTables(array $tblNames) : array 
    {
        return $this->_dbModel->readTables($tblNames);
    }
    function getTableNames() : array 
    {
        return $this->_dbModel->getTableNames();
    }
}
?>