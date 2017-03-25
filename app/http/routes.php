<?php

$router = new \Vendor\Http\Router;

$router->resource('/api/user', 'UserController');

return $router;