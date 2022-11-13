<?php
namespace App\lf8;

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "buchladen";
    $conn = new \mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}
 
function CloseCon($conn)
{
     $conn -> close();
}

// $con = OpenCon();

// $result = $con->query('select * from buchladen.buecher;');
// // var_dump($result->fetch_all());
// $resultArray = $result->fetch_all(MYSQLI_ASSOC);
// $columns = array();
// $columns = array_keys($resultArray[0]);

// $resultView = array();
// // $resultView['columns'] = $columns;
// $resultView['row'] = array();
// var_dump($resultArray[0][$columns[0]]);
// var_dump($resultArray);
// foreach($resultArray[0] as $row) 
// {
//     echo $row.'<br>';
// }
// $resultView = ['columns' => $columns,'rows' => $resultArray];

// var_dump($resultView);

?>