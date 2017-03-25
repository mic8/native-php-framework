<?php

$router = include('app/http/routes.php');
$app = new \Vendor\Compiler\App($router);