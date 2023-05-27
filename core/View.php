<?php 
namespace core;

use ErrorException;

class View {
   
    public static function render(string $view, array $data = [])
    {
       extract($data,EXTR_SKIP);

       $view = dirname(__DIR__) . "/app/views/" . $view . ".php";
       if(is_readable($view)){
         require $view;
       } else {
        throw new ErrorException("View " . $view . " not found");
       }
      
    }
}

?>