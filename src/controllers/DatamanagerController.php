<?php
namespace App\lf8\controllers;

use App\lf8\AbstractCrudController;
use App\lf8\models\DatamanagerDatabaseModel;

class DatamanagerController extends AbstractCrudController 
{
    private $_dbModel;
    // INS MODEL!!!
    private $_tableNames;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->_dbModel = new DatamanagerDatabaseModel($config);
        $this->_tableNames = $this->_dbModel->getTableNames();
    }

    // switch over get and post
    function create() 
    {
        switch($this->getRequestMethod()) 
        {
            case 'GET':
                // display an empty form for the tables
                $this->createNewEntry($this->getGet('tblid'));
                break;
            case 'POST':
                // get the hole shit for the table columns out of the post and let the model update
                // display the entry and a success message
                $this->saveNewEntry($this->getGet('tblid'));
                break;
        }
    }
    // is everytime a get
    function read() 
    {
        $tblid=$this->getGet('tblid');
        $id = $this->getGet('id');
        if(!empty($tblid) && $this->_dbModel->tableExist($tblid) && empty($id)) {
            $table = $this->_dbModel->readAllFromTbl($tblid);
            echo $this->render('datamanager/datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tables' => $table,
                'tableNames'=>$this->_tableNames,
                'template'=>'datamanager/buecher/table.html.twig']);
        } else if(!empty($tblid) && $this->_dbModel->tableExist($tblid)  && !empty($id)) {
            $entry = $this->_dbModel->readEntryFromTbl($tblid,$id);
            echo $this->render('datamanager/datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tableNames'=>$this->_tableNames,
                'entry' => $entry,
                'tblid' => $tblid,
                'pk' => $id,
                'template'=>'datamanager/buecher/form-read.html.twig']);
        } else {
            $this->renderMessage("Fehler beim lesen von Einträgen ...","Datamanager");
        }
    }
    function update() 
    {
        $tblid=$this->getGet('tblid');
        $id = $this->getGet('id');
        switch($this->getRequestMethod()) {
            case 'GET':
                $this->updateEntry($tblid,$id);
                break;
            case 'POST':
                // let model update this shit
                // get the column names for this table from the post as value 
                // let the mode update the entry 
                // display a succes message
                $this->saveUpdatedEntry($tblid,$id);
                break;
        }
    }
    function delete() 
    {
        $tblid=$this->getGet('tblid');
        $id = $this->getGet('id');
        switch($this->getRequestMethod()) {
            case 'GET':
                $this->deleteEntry($tblid,$id);
                break;
            case 'POST':
                // let model update this shit
                // get the column names for this table from the post as value 
                // let the mode update the entry 
                // display a succes message
                $this->saveDeleteEntry($tblid,$id);
                break;
        }
    }
    
    function default() 
    {
        echo parent::render('datamanager/datamanager.html.twig',['nav'=>$this->_nav,'tableNames'=>$this->_tableNames,'template'=>'']);
    }

    function readTables(array $tblNames) : array 
    {
        return array();
    }
    /**
     * Undocumented function
     *
     * @param [type] $tblid
     * @return void
     */
    private function createNewEntry($tblid) 
    {
        $this->default();
    }
    /**
     * Undocumented function
     *
     * @param [type] $tblid
     * @return void
     */
    private function saveNewEntry($tblid) 
    {

    }
    /**
     * display the entry to edit
     *
     * @param [type] $tblid
     * @param [type] $id
     * @return void
     */
    private function updateEntry($tblid,$id) 
    {
        if(!empty($tblid) && !empty($id)) {
            $pk_column = $this->_dbModel->getPrimaryKeyColumns($tblid);
            $idWhere = 'WHERE ';
            $pk_fromParameter = $this->_dbModel->getPrimaryKeyFromParameter($id);
            if(!is_array($pk_fromParameter)) 
            {
                $idWhere .= $pk_column[0] . "=" . $id;
            } 
            else 
            {
                foreach($pk_column as $key=>$value) 
                {
                    echo $value . ":" .$pk_fromParameter[$key] . "<br>";
                    if($key == 0) 
                    {
                        $idWhere .= $value . "=" . $pk_fromParameter[$key];
                    } else {
                        $idWhere .= " AND " . $value . "=" .$pk_fromParameter[$key];
                    }
                }
            }
            $this->_dbModel->query("SELECT * FROM " . $tblid . " " . $idWhere);
            $entry = $this->_dbModel->fetchAssoc();
            echo $this->render('datamanager/datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tableNames'=>$this->_tableNames,
                'entry' => $entry,
                'tblid' => $tblid,
                'pk' => $id,
                'template'=>'datamanager/buecher/form-edit.html.twig']);
        } 
        else 
        {
            $this->renderMessage("Fehler beim update eines Eintrages ... ","Datamanager");
        }
    }
    /**
     * save the edited entry to the database
     *
     * @param [type] $tblid
     * @param [type] $id
     * @return void
     */
    private function saveUpdatedEntry($tblid,$id) 
    {

    }
    /**
     * display the entry to delete
     * 
     * @param [type] $tblid
     * @param [type] $id
     * @return void
     */
    private function deleteEntry($tblid,$id) 
    {

    }
    /**
     * save the entry from the database
     * _dbModel->deleteEntry($tblid,$id)
     * @param [type] $tblid
     * @param [type] $id
     * @return void
     */
    private function saveDeleteEntry($tblid,$id)
    {

    }
    private function renderMessage($message,$returnUrl) 
    {
        // something went wrong here
        echo $this->render('datamanager/datamanager.html.twig',[
            'nav'=>$this->_nav,
            'tableNames'=>$this->_tableNames,
            'message' => $message,
            'returnUrl' => $returnUrl,
            'template'=>'datamanager/buecher/message.html.twig']);
    }
}
?>