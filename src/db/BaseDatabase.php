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
  /**
   * flag to indecate if the connection is already closed
   * @var bool
   */
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
    return $this->_connection;
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

  public function getPrimaryKeyColumns(string $table) : array 
  {
    $this->query('SHOW KEYS FROM ' . $table . ' WHERE Key_name = \'PRIMARY\'');
    $primaryKeyColumns=[];
    while($row = $this->_result->fetch_assoc()) 
    {
      array_push($primaryKeyColumns,$row['Column_name']);
    }

    return $primaryKeyColumns;
  }

  public function getPrimaryKeyAsParameter(array $pk,array $row) : string
  {
    // pk contains the names of the pk column
    if(count($pk) == 1) {
      return $row[$pk[0]];
    }
    $pk_array = array();
    foreach($pk as $value) 
    {
      array_push($pk_array,$row[$value]);
    }
    return implode("*",$pk_array);
  }

  public function getPrimaryKeyFromParameter(string $pkParam) : array | string 
  {
    if(str_contains($pkParam,"*")) 
    {
      return explode('*',$pkParam);
    }
    return $pkParam;
  }

  public function hasCompositeId(string $table) : bool 
  {
    if(count($this->getPrimaryKeyColumns($table)) > 1) {
      return true;
    }
    return false;
  }

  /**
   * Read one full table from the database and return an array
   * with the rows as result with the pks
   * @param string $tableName
   * @return array
   */
  public function readTable(string $tableName) : array
  {
    $this->query('SELECT * FROM ' . $tableName);
    $result = $this->fetchAssoc();
    $rows = array();
    $pk = $this->getPrimaryKeyColumns($tableName);
    foreach($result as $key => $row) {
      $rows[$key]['pk'] = $this->getPrimaryKeyAsParameter($pk, $row);
      $rows[$key]['rrow']  = $row;
    }
    return array(
      'pk'=> $pk,
      'name'=>$tableName,
      'columns'=>$this->getColumns($result),
      'rows'=>$rows);
  }

  public function getColumns(array $result) : array 
  {
    return array_keys($result[0]);
  }

  /** 
   * boa ist das eklig
   */
  public function getColumnNames(string $tblid) : array 
  {
    $sql = "SHOW COLUMNS FROM $tblid";
    $this->query($sql);
    $result = $this->fetchAssoc();
    $cols = array();
    foreach($result as $value) {
      $cols[]=$value['Field'];
    }

    return $cols;
  }

  public function readAllTables(array $tblNames) : array 
  {
      $tables = array();
      foreach($tblNames as $tableName)
      {
          $tables[$tableName] = $this->readTable($tableName);
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