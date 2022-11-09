<?php
namespace App\lf8;



require_once('config.php');

require __DIR__ .'/AbstractController.php';
// if($db_name) {
//     echo $db_name;
// }


class Index extends AbstractController 
{
    private $_command;
    private $_nav;
    public function __construct($nav)
    {
        parent::__construct();
        $this->_nav = $nav;
        $this->_command = $this->getGet('command');
        $this->setup();
    }
    private function setup() 
    {
        switch($this->_command) {
            case 'create':
                break;
            case 'read':
                break;
            case 'update':
                break;
            case 'delete':
                break;
            default:
                echo $this->_command;
                break;
        }
    }
    public function render() 
    {
        echo $this->_twig->render('index.html.twig',['nav'=>$this->_nav]);
    }
}
?>