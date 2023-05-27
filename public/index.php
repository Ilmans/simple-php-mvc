<?php

use app\controllers\HomeController;
use core\Router;
require_once '../vendor/autoload.php';


// using {params} if want to use parameter
// ex : Router::get('/user/{id}'.[UserController::class,'show']);
Router::get("/",[HomeController::class,'index']);
Router::get('/tes',[HomeController::class,"ah"]);

Router::run();

?>