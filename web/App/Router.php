<?php

namespace App;

class Router
{
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function routing(string $requestUri, $data = null)
    {
        foreach ($this->config->routs as $uri => $setup) {
            if ($uri == $requestUri) {
                $controller = new $setup['controller']($this, $this->config);
                $controller->{$setup['action']}($data);
            }
        }
    }
}
