<?php
namespace App\lf8\controllers;

use App\lf8\AbstractCrudController;
use App\lf8\models\DatamanagerDatabaseModel;

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
        $id = $this->getGet('id');
        if(!empty($tblid) && empty($id)) {
            $tables = $this->_dbModel->readAllTables([$tblid]);
            echo $this->render('datamanager/datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tables' => $tables,
                'tableNames'=>$this->_tableNames,
                'template'=>'datamanager/buecher/table.html.twig']);
        } else if(!empty($tblid) && !empty($id)) {
            $pk_column = $this->_dbModel->getPrimaryKey($tblid);
            // something like that shit
            // find all pk_keys
            // check if the given id count matches the pk columns
            // build the where clause and assume that the first id is for the first pk key
            // \O_i/
            $idWhere = 'WHERE ';
            if(is_array($id) && count($pk_column)>1) #
            {
                foreach($id as $key=>$pk) 
                {
                    $idWhere .= "$pk_column[$key]" . "=$pk";
                }
            }
            // $entry = $this->_dbModel->readSingleEntry($tblid,$id);
            $this->_dbModel->query("SELECT * FROM " . $tblid . " where $pk_column[0] =" . $id);
            $entry = $this->_dbModel->fetchAssoc();
            echo $this->render('datamanager/datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tableNames'=>$this->_tableNames,
                'entry' => $entry,
                'template'=>'datamanager/buecher/form-read.html.twig']);
        } else {
            return $this->default();
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
        return array();
    }
}
?>