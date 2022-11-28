<?php
namespace App\lf8;

class Router 
{
    private const NAMESPACE = 'App\lf8\\';
    private const CONTROLLER = 'Controller';
    private const INDEX = 'Index';
    
    private const BASE_CONTROLLER = 'AbstractBaseController';

    private function request_path()
    {
        $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($parts))
        {
            return '/';
        }
        
        // $path = $parts[1];//implode('/', $parts);
        $path = implode('/',$parts);
        if (($position = strpos($path, '?')) !== FALSE)
        {
            $path = substr($path, 0, $position);
        }
        return $path;
    }
    public function routeStatic(array $config) 
    {
        $path = $this->request_path();
        if(isset($config['routes'][strtolower($path)])) 
        {
            $class = $config['routes'][strtolower($path)];
            $className = '\\'.__NAMESPACE__.'\\'. $class;
            $class = new $className();
            $class->setup($config);
            $class->build();
        }
    }
    public function route(array $config) 
    {
        $path = $this->request_path();
        if($path === '/') 
        {
            $path=self::INDEX;
        }
        $class = '\\'.__NAMESPACE__.'\\'. $path . self::CONTROLLER;
        $index = new $class($config);
        if(!is_subclass_of($index,self::NAMESPACE . self::BASE_CONTROLLER))
        {
            self::error_page("Somthing went wrong on $path<br>Class must extend AbstractController");
        }
        // $index->setup();
        $index->build();
    }
    private function error_page($message) 
    {
        echo "<h1>ERROR</h1>"
            . $message;
        die();
    }
    private function file_exists($fileName, $caseSensitive = true) {
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