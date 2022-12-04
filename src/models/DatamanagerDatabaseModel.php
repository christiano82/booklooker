<?php
namespace App\lf8\models;

use App\lf8\db\BaseDatabase;

class DatamanagerDatabaseModel extends BaseDatabase
{
    public function __construct($config)
    {
        parent::__construct($config['db']);
    }
}
?>