<?php 
namespace app\controllers;

use app\models\User;
use core\Controller;

class UserController extends Controller {

  protected $userModel;
  public function __construct()
  {
    $this->userModel = new User;
  }
  public function show ($id) {
    $user = $this->userModel->find($id);
   echo $user->name;
  }
}
?>