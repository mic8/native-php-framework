<?php

/**
 * All web routes
 * This routes are for user access view directly
 * Not for RESTFUL, for the RESTFUL API please see api.php file
 */

$router = new \Vendor\Http\Router;

$router->get('/', 'HomeController@index');

return $router;