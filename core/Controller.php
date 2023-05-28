<?php 
namespace core;

use ErrorException;


abstract class Controller {
 

    public function __call($method, $arguments)
    {
        throw new ErrorException("Method " . $method . " not exists in ". get_class($this));
    }
}
?>