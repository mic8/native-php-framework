<?php

class Connection extends \mysqli
{
    public function __construct($host, $username, $passwd, $dbname, $port, $socket)
    {
        parent::__construct($host, $username, $passwd, $dbname, $port, $socket);
    }
}