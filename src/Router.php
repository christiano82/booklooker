<?php
namespace App\lf8;

class Router 
{
    function request_path()
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
    function route() 
    {
        require_once('config.php');
        $path = $this->request_path();
        if($path === '/') 
        {
            // get the filename for the indexController
            // 
            $ctrName = 'Index';
            $fileName = self::fileExists(__DIR__.'/'.$ctrName.'.php',false);
            if($fileName) 
            {
                echo $fileName;
                require_once ($fileName);
                $class = 'App\lf8\\'.$ctrName;
                $index = new $class($nav);
                echo $index->render();
            }
        }
        else 
        {
            $fileName = self::fileExists(__DIR__.'/'.$path.'.php',false);
            if($fileName)
            {
                require_once ($fileName);
                $class = 'App\lf8\\'.$path;
                $index = new $class($nav);
                echo $index->render();
            }
        }
    }
    function fileExists($fileName, $caseSensitive = true) {
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