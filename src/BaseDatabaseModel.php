<?php
namespace App\lf8;


class BaseDatabaseModel 
{

    protected $_dbName;
    protected $_queryResult;
    protected $_dbConfig;
    protected $_dbConnectId;

    public function __construct($config)
    {
        $this->_dbConfig = $config['db'];
        $this->sql_connect();
    }

    
    protected function sql_connect(): void {
        // $this->_dbConnectId = new \mysqli($this->_dbConfig['db']['host'], $this->_dbConfig['db']['user'], $this->_dbConfig['db']['password'], $this->_dbConfig['db']['name']) or die("Connect failed: %s\n". $this->_dbConnectId -> error);
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $db = "buchladen";
        $conn = new \mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    }

    protected function sql_close(): void {
        $this->_dbConnectId->close();
    }

    protected function sql_query($query) {
        $this->sql_connect();
        return $this->_dbConnectId;
    }

    protected function getConnectionId() {
        return $this->_dbConnectId;
    }
}
?>