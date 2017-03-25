<?php

$httpHost = $_SERVER['HTTP_HOST'];
$pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestScheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';

$scriptName = $_SERVER['SCRIPT_NAME'];
$scriptName = trim(str_ireplace('index.php', null, $scriptName));

$baseUrl = $requestScheme . '://' . $httpHost . $scriptName;

define('BASE_URL', $baseUrl);
define('REQUEST_METHOD', $requestMethod);
define('ACTIVE_ROUTE', trim($pathInfo));
define('CONTROLLER_PATH', 'App\Http\Controllers\\');