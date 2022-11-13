<?php
namespace App\lf8;
require __DIR__ . '/../vendor/autoload.php';
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

abstract class AbstractController 
{
    protected $_command;
    protected $_nav;
    protected $_twig;
    function __construct()
    {
        $loader = new FilesystemLoader('../templates');
        $this->_twig = new Environment($loader, [
            'cache' => '../var/cache','debug'=>true
        ]);
    }
    public function setup($nav) 
    {
        $this->_nav = $nav;
        $this->_command = $this->getGet('command');
    }

    public function build() 
    {
        switch($this->_command) {
            case 'create':
                $this->create();
                break;
            case 'read':
                $this->read();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->default();
                break;
        }
    }
    protected function getGet(string $parameter) : ?string {
        if(isset($_GET[$parameter])
            && !empty($_GET[$parameter])) {
            return $_GET[$parameter];
        }
        return null;
    }
    function render(string $template,array $vars) 
    {
        return $this->_twig->render($template,$vars);
    }
    abstract function create();
    abstract function read();
    abstract function update();
    abstract function delete();
    abstract function default();
}
?>