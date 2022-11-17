<?php
namespace App\lf8;
require __DIR__ . '/../vendor/autoload.php';
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class AbstractBaseController
{
    protected $_command;
    protected $_nav;
    protected $_twig;
    protected $_config;
    function __construct()
    {
        $loader = new FilesystemLoader('../templates');
        $this->_twig = new Environment($loader, [
            'cache' => '../var/cache','debug'=>true
        ]);
    }
    public function setup($config) 
    {
        $this->_nav = $config['nav'];
        $this->_config = $config;
        $this->_command = $this->getGet('command');
        if($this->_command == null) 
        {
            $this->_command = $this->getPost('command');
        }
    }
    protected function getGet(string $parameter) : ?string {
        if(isset($_GET[$parameter])
            && !empty($_GET[$parameter])) {
            return $_GET[$parameter];
        }
        return null;
    }
    protected function getPost(string $parameter) : ?string {
        if(isset($_POST[$parameter]) && !empty($_POST[$parameter])) {
            return trim($_POST[$parameter]);
        }
        return null;
    }
    protected function render(string $template,array $vars) 
    {
        return $this->_twig->render($template,$vars);
    }
}