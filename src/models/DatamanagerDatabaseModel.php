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
       return $this->readAllTables($this->getTableNames());
    }
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
    public function deleteEntry($tblid,$id) : bool | string
    {
        $pkCol = $this->getPrimaryKeyColumns($tblid);
        $pkId = $this->getPrimaryKeyFromParameter($id);
        $stmt = "DELETE FROM $tblid WHERE ";
        if(is_array($pkId)) 
        {
            foreach($pkCol as $key=>$value) 
            {
                if($key != 0) {
                    $stmt .= " AND ";
                }
                $stmt .= " $value = $pkId[$key] ";
            }
        } else {
            $stmt .= "$pkCol[0]=" . $pkId;
        }
        if($this->query($stmt)) {
            return true;
        }
        return $this->_connection->error;
    }
    /**
     * update the entry with the given values from $row 
     * return true if updated otherwise false
     * @param [type] $tblid
     * @param [type] $id
     * @param [type] $row assoziativ array with column=>postedValue
     * @return boolean|string
     */
    public function updateEntry($tblid,$id,$row) : bool | string
    {
        $pkCol = $this->getPrimaryKeyColumns($tblid);
        $pkId = $this->getPrimaryKeyFromParameter($id);
        $stmt = "UPDATE $tblid SET ";
        $i = 0;
        foreach($row as $key=>$value) 
        {
            if(!in_array($key,$pkCol,true)) {
                if($i != 0) { $stmt .= ',';}
                $i++;
                $stmt .= " $key = '$value' ";
            }
            
        }
        $stmt .= " WHERE ";
        if(is_array($pkId)) 
        {
            foreach($pkCol as $key=>$value) 
            {
                if($key != 0) {
                    $stmt .= " AND ";
                }
                $stmt .= " $value = $pkId[$key] ";
            }
        } else {
            $stmt .= "$pkCol[0]=" . $pkId;
        }
        echo $stmt;
        if($this->query($stmt)) {
            return true;
        }
        return $this->_connection->error;
    }
    /**
     * create an entry from the data in row
     * return the id if created 
     * @param [type] $tblid
     * @param [type] $row
     * @return string|int
     */
    public function createEntry($tblid,$row) : string | int
    {
        $stmt = "INSERT INTO $tblid VALUES (";
        foreach($row as $key=>$value) 
        {
            $stmt .= " $key = $value ";
        }
        $stmt .= ")";
        if($this->query($stmt)) {
            return $this->_connection->insert_id;
        }
        return $this->_connection->error;
    }
    /**
     * reset the database
     *
     * @return void
     */
    public function resetDatabase() 
    {
        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        //__DIR__ . '../../public/' .$this->_dbonfig['sql.dump']
        $lines = file('../public/buchladen.sql');
        // Loop through each line
        foreach ($lines as $line)
        {
            
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
            {
                
                // Perform the query
                $this->query($templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }
    }
}
?>