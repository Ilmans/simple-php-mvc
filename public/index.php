<?php

use core\Config;
use core\Router;

require_once '../vendor/autoload.php';
require '../app/routes.php';
Config::loadAll();
Router::run();

?>