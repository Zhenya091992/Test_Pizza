<?php

require __DIR__.'/../App/vendor/autoload.php';

use App\Config;
use App\Router;

$config = Config::instance();
$router = new Router($config);
$router->routing($_SERVER['REQUEST_URI']);
