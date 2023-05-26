<?php
namespace core;

use ErrorException;

class Router
{
    private static array $routes = [];

    /* registering route
       @return void;
     */
    private static function registerRoute( string $method,string $path,  string $controller, string $function) {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
        ];
    }
    /*
      @return void;
     */
    public static function get(string $path,array $data = ['HomeController', 'index']) 
    {
        self::registerRoute('get', $path, $data[0], $data[1]);
    }
    /*
      @return void;
     */
    public static function post( string $path, array $data = ['HomeController', 'index'] )  
    {
        self::registerRoute('post', $path, $data[0], $data[1]);
    }

    public static function run() : void
    {
        $path = '/';
        if (array_key_exists('PATH_INFO', $_SERVER)) {
            $path = $_SERVER['PATH_INFO'];
        }
       
        foreach (self::$routes as $route) {
           if($route['path'] === $path) {
             if(strtoupper($route['method']) !== $_SERVER['REQUEST_METHOD']){
                throw new ErrorException("No support " . $_SERVER['REQUEST_METHOD'] . " method for this route");
             } 
             $controller = $route['controller'];
             $function = $route['function'];
             if(class_exists($controller)){
                
             } else {
                throw new ErrorException("Class " . $controller . " not exists");
             }
           }
        }

        http_response_code(404);
        die('The requested URL was not found.');
    }
}

?>
