<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('connection.php');
include('user.php');

$conn = new Connection('localhost', 'root', '0000', '2017_project_app_vue', 3306, ini_get('mysqli.default_socket'));

$user = new User($conn);
$user->all();