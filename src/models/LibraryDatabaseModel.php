<?php

namespace App\lf8\models;

use App\lf8\db\BaseDatabase;

class LibraryDatabaseModel extends BaseDatabase 
{
    private $_config;

    function __construct($config)
    {
        $this->_config = $config;
        parent::__construct($config['db']);
    }

    function getTableNames() : array 
    {
        return $this->getTableNames();
    }

    function readTables(array $tblNames) : array 
    {
        return $this->readAllTables($tblNames);
    }

    function readCustomSelect(string $stmt) : array 
    {
        $this->query($stmt);
        $results = $this->fetchAssoc();

        $table = [];
        $table['complex'] = ['complex'=>true,'name' => $stmt, 'columns' => $this->getColumns($results), 'rows' => $results];
        return $table;
    }
}

?>