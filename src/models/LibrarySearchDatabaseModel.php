<?php

namespace App\lf8\models;

use App\lf8\db\BaseDatabase;

class LibrarySearchDatabaseModel extends BaseDatabase {

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
        return $this->readAllTables($tblNames);
    }

    function readCustomSelect(string $stmt) : array 
    {
        parent::query($stmt);
        $results = parent::fetchAssoc();

        $table = [];
        $table['complex'] = ['complex'=>true,'name' => $stmt, 'columns' => parent::getColumns($results), 'rows' => $results];
        return $table;
    }
}

?>