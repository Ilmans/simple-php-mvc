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
            'path' => $path == "" || $path == " " ? "/" : rtrim($path," "),
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
  
           if(self::isMatch($path,$route['path'])){
             if(strtoupper($route['method']) !== $_SERVER['REQUEST_METHOD']){
                throw new ErrorException("No support " . $_SERVER['REQUEST_METHOD'] . " method for this route");
             } 
             $controller = $route['controller'];
             $function = $route['function'];
             if(class_exists($controller)){
               $params = self::getParams($path,$route['path']);
                $object_controller = new $controller();
                $object_controller->$function(...$params);
                return;
             } else {
                throw new ErrorException("Class " . $controller . " not exists");
             }
           }
        }

        http_response_code(404);
        die('The requested URL was not found.');
    }


  protected static function isMatch($uri, $routeRegistered) {
    $uriParts = explode('/', rtrim($uri,'/'));
    $routeParts = explode('/', $routeRegistered);

    // Check if the number of URI parts matches the number of route parts
    if (count($uriParts) !== count($routeParts)) {
        return false;
    }

    for ($i = 0; $i < count($routeParts); $i++) {
        $routePart = $routeParts[$i];
        $uriPart = $uriParts[$i];

        if (strpos($routePart, '{') === false && $routePart !== $uriPart) {
            // Parts don't match
            return false;
        }
    }

    return true;
}

protected static function getParams($uri, $routeRegistered) {
    $params = array();
    $uriParts = explode('/', $uri);
    $routeParts = explode('/', $routeRegistered);

    for ($i = 0; $i < count($routeParts); $i++) {
        $routePart = $routeParts[$i];
        $uriPart = $uriParts[$i];

        if (strpos($routePart, '{') !== false && strpos($routePart, '}') !== false) {
            // Wildcard found
            $wildcardName = trim($routePart, '{}');
            array_push($params,$uriPart);
        }
    }

    return $params;
}


}

?>
