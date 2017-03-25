<?php

/**
 * All RESTFUL API routes
 * This routes are for RESTFUL api with prefix /api
 * Not for web routes, for the web routes please see web.php file
 */

$router = new \Vendor\Http\Router(true);

$router->resource('/user', 'Api\UserController');

return $router;