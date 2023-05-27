<?php 
namespace app\controllers;

use core\Controller;
use core\View;

class HomeController extends Controller {
    

     public function index () {
      
       return View::render('home',[
        'user' => 'ilman'
       ]); 
     }
}

?>