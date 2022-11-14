<?php
namespace App\lf8;
require_once('Database.php');
class DatamanagerController extends AbstractCrudController 
{

    function create() {}
    function read() 
    {
        $tblid=$this->getGet('tblid');
        if($tblid == 'buecher') {
            $tables = $this->readTables([$tblid]);
            echo $this->render('datamanager.html.twig',[
                'nav'=>$this->_nav,
                'tables' => $tables,
                'template'=>'datamanager/buecher/table.html.twig']);
        }
    }
    function update() {}
    function delete() {}
    function default() 
    {
        echo parent::render('datamanager.html.twig',['nav'=>$this->_nav,'template'=>'']);
    }
    function readTables(array $tblNames) : array 
    {
        $mysqli = OpenCon();
        $tables = array();
        foreach($tblNames as $table)
        {
            $result = $mysqli->query('SELECT * FROM buchladen.'.$table.';');
            $resultArray = $result->fetch_all(MYSQLI_ASSOC);
            $columns = array();
            $columns = array_keys($resultArray[0]);
            $tables[$table] = ['name'=>$table,'columns'=>$columns,'rows'=>$resultArray];
            $result->free_result();
        }
        CloseCon($mysqli);
        return $tables;
    }
}
?>