<?php 
namespace app\controllers;

use core\Config;
use core\Controller;
use core\View;

class HomeController extends Controller {
    

     public function index () {
      echo Config::get('database.name');
       return View::render('home',[
        'user' => 'ilman'
       ]); 
     }
}

?>