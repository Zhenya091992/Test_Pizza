<?php

namespace App\Controllers;

use App\Config;
use App\Router;
use App\View;

abstract class Controller
{
    protected $config;

    protected $view;
    protected $router;

    public function __construct(Router $router, Config $config)
    {
        $this->router = $router;
        $this->config = $config;
        $this->view = new View($config);
    }
}
