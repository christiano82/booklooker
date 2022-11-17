<?php

namespace App\lf8;

class LibraryDatabaseModel extends BaseDatabaseModel {

    function __construct($config)
    {
        parent::__construct($config);
    }

    function getTableNames() : array 
    {
                   
        $result = $this->_dbConnectId->query('show tables');
        $tableNames=[];
        while($names = $result->fetch_array()) 
        {
            array_push($tableNames,$names[0]); 
        };
        
        return $tableNames;
    }

    function readTables(array $tblNames) : array 
    {

        $tables = array();
        foreach($tblNames as $table)
        {
            $result = $this->_dbConnectId->query('SELECT * FROM buchladen.'.$table.';');
            $resultArray = $result->fetch_all(MYSQLI_ASSOC);
            $columns = array();
            $columns = array_keys($resultArray[0]);
            $tables[$table] = ['pk'=> 'diespalte','name'=>$table,'columns'=>$columns,'rows'=>$resultArray];
            $result->free_result();
        }
        return $tables;
    }
    function readCustomSelect(string $stmt) : array 
    {
        $query = $this->_dbConnectId->query($stmt);
        $results = $query->fetch_all(MYSQLI_ASSOC);

        $table = [];
        $table['complex'] = ['name' => $stmt, 'columns' => $this->getColumnsFromResults($results), 'rows' => $results];
        return $table;
    }

    function getColumnsFromResults($results) : array {
        return array_keys($results[0]);
    }
}

?>