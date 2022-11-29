<?php

namespace App\lf8\db;

use mysqli;
use mysqli_result;
use RuntimeException;

class BaseDatabase 
{
  protected $_dbConfig;
  /**
   * @var mysqli
   */
  protected $_connection;
  /**
   * @var mysqli_result
   */
  protected $_result;
  protected $_isClosed;

  public function __construct($dbConfig)
  {
    $this->_dbConfig = $dbConfig;
    $this->connect();
  }
  public function connect(): mysqli
  {
    if($this->isConnected()) 
    {
      $this->close();
    }
    $this->_connection = new mysqli(
                              $this->_dbConfig['host'],
                              $this->_dbConfig['user'],
                              $this->_dbConfig['password'],
                              $this->_dbConfig['name'],
                              $this->_dbConfig['port']);
    if($this->_connection->connect_errno) 
    {
      throw new RuntimeException("mysql connection error: " . $this->_connection->connect_error);
    }
                    
    return $this->_connection;      
  }

  public function getConnection() : mysqli 
  {
    if(!$this->isConnected())
    {
      $this->connect();
    } 
    // else {
      return $this->_connection;
    //   return $this->_connection;
    // }
  }

  public function query(string $stmt) : mysqli_result | bool
  {
    return $this->_result = $this->_connection->query($stmt);
  }
  
  public function fetchAssoc() : array
  {
    return $this->_result->fetch_all(MYSQLI_ASSOC);
  }

  function getTableNames() : array 
  {
    $this->query('show tables');
    $tableNames=[];
    while($names = $this->_result->fetch_array()) 
    {
        array_push($tableNames,$names[0]); 
    };
    
    return $tableNames;
  }

  public function getPrimaryKey(string $table) : array 
  {
    $this->query('SHOW KEYS FROM ' . $table . ' WHERE Key_name = \'PRIMARY\'');
    $primaryKeyColumns=[];
    while($row = $this->_result->fetch_assoc()) 
    {
      array_push($primaryKeyColumns,$row['Column_name']);
    }

    return $primaryKeyColumns;
  }

  public function readTable(string $tableName) : array
  {
    $this->query('SELECT * FROM ' . $tableName);
    $result = $this->fetchAssoc();

    return array(
      'pk'=> $this->getPrimaryKey($tableName),
      'name'=>$tableName,
      'columns'=>$this->getColumns($result),
      'rows'=>$result);
  }

  public function getColumns(array $result) : array 
  {
    return array_keys($result[0]);
  }
  public function readTables(array $tblNames) : array 
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
  public function isConnected() : bool 
  {
    return (is_resource($this->_connection) && (get_resource_type($this->_connection) === 'mysqli link'));
  }

  public function debugConnection() : string
  {
    if(!$this->isConnected()) 
    {
      $this->connect();
    }
    return 'Host-Info: ' . $this->_connection->host_info . '<br>' . 
           'Client-Info: ' . $this->_connection->client_info . '<br>' .
           'Server-Info: ' . $this->_connection->server_info;//->connection_status;
  }

  public function close() : bool 
  {
    return $this->_connection->close();
  }
}
?>