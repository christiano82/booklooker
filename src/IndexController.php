<?php
namespace App\lf8;

require __DIR__ .'/AbstractController.php';

class IndexController extends AbstractController 
{
    private $_command;
    private $_nav;
    
    public function setup($nav) 
    {
        parent::__construct();
        $this->_nav = $nav;
        $this->_command = $this->getGet('command');
    }

    public function build() 
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