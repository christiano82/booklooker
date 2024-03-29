<?php
namespace App\lf8;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class AbstractBaseController
{
    protected $_command;
    protected $_nav;
    protected $_twig;
    protected $_config;
    function __construct($config)
    {
        $this->setup($config);
        $loader = new FilesystemLoader('../templates');
        $this->_twig = new Environment($loader, [
            'cache' => '../var/cache','debug'=>true
        ]);
    }
    private function setup($config) 
    {
        $this->_nav = $config['nav'];
        $this->_config = $config;
        $this->_command = $this->getCommand();
    }
    protected function getCommand() 
    {
        $c = $this->getGet('command');
        if($c == null ) 
        {
            $c = $this->getPost('command');
        }
        return $c;
    }
    /**
     * @param parameter to get the value
     * @return value for the paramter
     */
    protected function getRequestParameterValue(string $parameter) : string|array|null 
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch($method) 
        {
            case 'GET':
                return $this->getGet($parameter);
            case 'POST':
                return $this->getPost($parameter);
            default:
                return null;
        }
    }
    protected function getGet(string $parameter): string|array|null {
        if(isset($_GET[$parameter])
            && !empty($_GET[$parameter])) {
            return $_GET[$parameter];
        }
        return null;
    }
    protected function getPost(string $parameter) : string|array|null {
        if(isset($_POST[$parameter]) && !empty($_POST[$parameter])) {
            return trim($_POST[$parameter]);
        }
        return null;
    }
    protected function render(string $template,array $vars) 
    {
        return $this->_twig->render($template,$vars);
    }
    protected function getRequestMethod() 
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * get the post data from key and store it assoziativ
     *
     * @param array $keys
     * @return array
     */
    protected function getPostDataArray(array $keys) : array 
    {
        $postedArray = array();
        foreach($keys as $key) 
        {
            $v = $this->getPost($key);
            if(isset($v) && !empty($v)) 
            {
                $postedArray[$key] = $v;
            }
        }
        return $postedArray;
    }
}