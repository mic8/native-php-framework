<?php

/**
 * Default header framework
 */

$headers = include('config/headers.php');

header('Access-Control-Allow-Origin: ' . $headers['origin']);
header('Access-Control-Allow-Methods: ' . $headers['methods']);
header('Access-Control-Allow-Headers: ' . $headers['headers']);