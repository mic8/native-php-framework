<?php

/**
 * Application initialization
 * Please don't change any line of this file
 */

$webRouter = include('routes/web.php');
$apiRouter = include('routes/api.php');

$app = new \Vendor\Compiler\App();