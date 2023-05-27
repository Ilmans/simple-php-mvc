<?php 

use app\controllers\HomeController;
use core\Router;

// using {params} if want to use parameter
// ex : Router::get('/user/{id}'.[UserController::class,'show']);

Router::get("/",[HomeController::class,'index']);
?>