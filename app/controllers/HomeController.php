<?php 
namespace app\controllers;

use core\Controller;

class HomeController extends Controller {
    

     public function index ($id,$k) {
       echo $id;
       echo $k;
     }
}

?>