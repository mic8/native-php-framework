<?php

namespace Vendor\Compiler;

use Vendor\Http\Router;

class App
{
    private $router;

    public function __construct()
    {
        $this->router = new Router();

        $this->init();
    }

    private function init()
    {
        $this->router->route(ACTIVE_ROUTE);
    }
}