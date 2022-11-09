<?php
namespace App\lf8;

class Router 
{
    private const NAMESPACE = 'App\lf8\\';
    private const CONTROLLER = 'Controller';
    private const INDEX = 'Index';
    
    private const BASE_CONTROLLER = 'AbstractController';

    private function request_path()
    {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($parts))
        {
            return '/';
        }
        
        $path = $parts[1];//implode('/', $parts);
        if (($position = strpos($path, '?')) !== FALSE)
        {
            $path = substr($path, 0, $position);
        }
        return $path;
    }
    public function route() 
    {
        $path = $this->request_path();
        if($path === '/') 
        {
            $path=self::INDEX;
        }
        $file = $path . self::CONTROLLER. '.php';
        $fileName = self::fileExists(__DIR__ . '/' . $file,false);
        if(!$fileName)
        {
            self::errorPage("Somthing went wrong on $path <br>FILE NOT FOUND");
        } 
        require_once('config.php');
        require_once ($fileName);
        $class = self::NAMESPACE . $path . self::CONTROLLER;
        $index = new $class();
        if(!is_subclass_of($index,self::NAMESPACE . self::BASE_CONTROLLER))
        {
            self::errorPage("Somthing went wrong on $path<br>Class must extend AbstractController");
        }
        $index->setup($nav);
        $index->build();
        echo $index->render();
    }
    private function errorPage($message) 
    {
        echo "<h1>ERROR</h1>"
            . $message;
        die();
    }
    private function fileExists($fileName, $caseSensitive = true) {
        if(file_exists(__DIR__.'/'.$fileName)) {
            return $fileName;
        }
        if($caseSensitive) return false;
    
        // Handle case insensitive requests            
        $fileArray = glob(__DIR__. '/*', GLOB_NOSORT);
        $fileNameLowerCase = strtolower($fileName);
        foreach($fileArray as $file) {
            if(strtolower($file) == $fileNameLowerCase) {
                return $file;
            }
        }
        return false;
    }
}

?>