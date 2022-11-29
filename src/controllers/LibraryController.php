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
        /*
        $mysqli = OpenCon();
        $query = $mysqli->query($stmt);
        $tables = array();
        $resultArray = $query->fetch_all(MYSQLI_ASSOC);
        $columns = array();
        $columns = array_keys($resultArray[0]);
        $tables['complex'] = ['name'=>$stmt,'columns'=>$columns,'rows'=>$resultArray];
        */
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
        /*
        $mysqli = OpenCon();
        $tables = array();
        foreach($tblNames as $table)
        {
            $result = $mysqli->query('SELECT * FROM buchladen.'.$table.';');
            $resultArray = $result->fetch_all(MYSQLI_ASSOC);
            $columns = array();
            $columns = array_keys($resultArray[0]);
            $tables[$table] = ['pk'=> 'diespalte','name'=>$table,'columns'=>$columns,'rows'=>$resultArray];
            $result->free_result();
        }
        CloseCon($mysqli);
        return $tables;
        */
        return $this->_dbModel->readTables($tblNames);
    }
    function getTableNames() : array 
    {
        /*
        $mysqli = OpenCon();
           
        $result = $mysqli->query('show tables');
        $tableNames=[];
        while($names = $result->fetch_array()) 
        {
            array_push($tableNames,$names[0]); 
        };
        CloseCon($mysqli);
        return $tableNames;
        */
        return $this->_dbModel->getTableNames();
    }
}
?>