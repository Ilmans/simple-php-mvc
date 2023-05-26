<?php

use app\controllers\HomeController;
use core\Router;
require_once '../vendor/autoload.php';



Router::get('/',[HomeController::class,'index']);

Router::run();

?>