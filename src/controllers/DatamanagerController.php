<?php
namespace App\lf8\controllers;

use App\lf8\AbstractCrudController;
use App\lf8\models\DatamanagerDatabaseModel;

// require_once(__DIR__ . '\..\Database.php');

class DatamanagerController extends AbstractCrudController 
{
    private $_dbModel;
    private $_tableNames;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->_dbModel = new DatamanagerDatabaseModel($config);
        $this->_tableNames = $this->_dbModel->getTableNames();
    }

    function create() {}
    function read() 
    {
        $tblid=$this->getGet('tblid');
        if(!empty($tblid)) {
            $tables = $this->_dbModel->readAllTables([$tblid]);
            echo $this->render('datamanager/datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tables' => $tables,
                'tableNames'=>$this->_tableNames,
                'template'=>'datamanager/buecher/table.html.twig']);
        }
    }
    function update() {}
    function delete() {}
    function default() 
    {
        echo parent::render('datamanager/datamanager.html.twig',['nav'=>$this->_nav,'tableNames'=>$this->_tableNames,'template'=>'']);
    }
    function readTables(array $tblNames) : array 
    {
        // $mysqli = OpenCon();
        // $tables = array();
        // foreach($tblNames as $table)
        // {
        //     $result = $mysqli->query('SELECT * FROM buchladen.'.$table.';');
        //     $resultArray = $result->fetch_all(MYSQLI_ASSOC);
        //     $columns = array();
        //     $columns = array_keys($resultArray[0]);
        //     $tables[$table] = ['name'=>$table,'columns'=>$columns,'rows'=>$resultArray];
        //     $result->free_result();
        // }
        // CloseCon($mysqli);
        // return $tables;
        return array();
    }
}
?>