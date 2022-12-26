<?php
namespace App\lf8\models;

use App\lf8\db\BaseDatabase;

class DatamanagerDatabaseModel extends BaseDatabase
{
    public function __construct($config)
    {
        parent::__construct($config['db']);
    }
    // MOVE TO BASE
    public function tableExist(string $table) 
    {
        foreach($this->getTableNames() as $value) 
        {
            if(strcmp($value,$table) == 0) 
            {
                return true;
            }
        }
        return false;
    }
    /**
     * readAll entries from the database
     *
     * @return array
     */
    public function readAll() : array { 
       return array();}
    /**
     * Undocumented function
     *
     * @param string $tblid
     * @return array
     */
    public function readAllFromTbl(string $tblid) : array {
        return $this->readAllTables([$tblid]);
    }
    /**
     * reads an entry from the table and returns it as an array
     *
     * @param string $tblid
     * @param [type] $id
     * @return array
     */
    public function readEntryFromTbl(string $tblid,$id) : array 
    {
        $pk_column = $this->getPrimaryKeyColumns($tblid);
        // @niclas, sowas muss in das model!!!
        // am besten gibt das model ein array für den renderer zurück
        // something like that shit
        // find all pk_keys
        // check if the given id count matches the pk columns
        // build the where clause and assume that the first id is for the first pk key
        // \O_i/
        $idWhere = 'WHERE ';
        // if(is_array($id) && count($pk_column)>1) #
        // {
        //     foreach($id as $key=>$pk) 
        //     {
        //         $idWhere .= "$pk_column[$key]" . "=$pk";
        //     }
        // }
        // MOVE TO DATABASEMODEL OR BASE DATABASE
        // FILTER BY ID function where the id is an parameter or parameter with seperator
        $pk_fromParameter = $this->getPrimaryKeyFromParameter($id);
        if(!is_array($pk_fromParameter)) 
        {
            $idWhere .= $pk_column[0] . "=" . $id;
        } 
        else 
        {
            foreach($pk_column as $key=>$value) 
            {
                if($key == 0) 
                {
                    $idWhere .= $value . "=" . $pk_fromParameter[$key];
                } else {
                    $idWhere .= " AND " . $value . "=" .$pk_fromParameter[$key];
                }
            }
        }
        // $entry = $this->_dbModel->readSingleEntry($tblid,$id);
        $this->query("SELECT * FROM " . $tblid . " " . $idWhere);
        return $this->fetchAssoc();
    }
    /**
     * delete an entry by its id from the table
     * return false if fail or true if delete
     * @param [type] $tblid
     * @param [type] $id
     * @return boolean
     */
    public function deleteEntry($tblid,$id) : bool 
    {
        return false;
    }
    /**
     * update the entry with the given values from $row 
     * return true if updated otherwise false
     * @param [type] $tblid
     * @param [type] $id
     * @param [type] $row
     * @return boolean
     */
    public function updateEntry($tblid,$id,$row) : bool 
    {
        return false;
    }
    /**
     * create an entry from the data in row
     * return the id if created 
     * @param [type] $tblid
     * @param [type] $row
     * @return string
     */
    public function createEntry($tblid,$row) : string | bool
    {
        return "id";
    }
}
?>