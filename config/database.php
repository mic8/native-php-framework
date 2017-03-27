<?php

/**
 * Database connector configuration <MySQLi>
 * Please modify this file for connection to database
 * Example:
 * host: localhost
 * username: root
 * password: 0000
 * database: foo
 * port: (default) 3306
 * socket: ini_get('mysqli.default_socket')
 */

return [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'foo',
    'port' => 3306,
    'socket' => ini_get('mysqli.default_socket')
];