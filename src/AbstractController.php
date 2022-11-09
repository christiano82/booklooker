<?php
namespace App\lf8;
require __DIR__ . '/../vendor/autoload.php';
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class AbstractController 
{
    protected $_twig;
    function __construct()
    {
        $loader = new FilesystemLoader('../templates');
        $this->_twig = new Environment($loader, [
            'cache' => '../var/cache','debug'=>true
        ]);
    }
    protected function getGet(string $parameter) : ?string {
        if(isset($_GET[$parameter])
            && !empty($_GET[$parameter])) {
            return $_GET[$parameter];
        }
        return null;
    }
}
?>