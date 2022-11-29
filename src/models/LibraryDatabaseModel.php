<?php

namespace App\lf8\models;

use App\lf8\db\BaseDatabase;

class LibraryDatabaseModel extends BaseDatabase {

    function __construct($config)
    {
        parent::__construct($config['db']);
    }

    function getTableNames() : array 
    {
        return parent::getTableNames();
    }

    function readTables(array $tblNames) : array 
    {

        $tables = array();
        foreach($tblNames as $table)
        {
            $tables[$table] = parent::readTable($table);
        }
        return $tables;
    }
    function readCustomSelect(string $stmt) : array 
    {
        parent::query($stmt);
        $results = parent::fetchAssoc();

        $table = [];
        $table['complex'] = ['name' => $stmt, 'columns' => parent::getColumns($results), 'rows' => $results];
        return $table;
    }
}

?>