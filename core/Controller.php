<?php 
namespace core;

use ErrorException;

abstract class Controller {

    private array $params = [];

    public function __call($method, $arguments)
    {
        if(method_exists($this,$method)){
            call_user_func($method,$this->params);
        }
        throw new ErrorException("Method " . $method . " not exists in ". get_class($this));
    }
}
?>