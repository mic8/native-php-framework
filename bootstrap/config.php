<?php

/**
 * All frmaework configuration
 * Please don't change any line of this file
 */

$httpHost = $_SERVER['HTTP_HOST'];
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestScheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';

$scriptName = $_SERVER['SCRIPT_NAME'];
$scriptName = trim(str_ireplace('index.php', null, $scriptName));

$baseUrl = $requestScheme . '://' . $httpHost . $scriptName;

/**
 * All global defined variables
 * Please don't change any defined global variable
 */
define('BASE_URL', $baseUrl);
define('REQUEST_METHOD', $requestMethod);
define('ACTIVE_ROUTE', trim($pathInfo));
define('CONTROLLER_PATH', 'App\Http\Controllers\\');
define('VIEW_PATH', 'resources/views');