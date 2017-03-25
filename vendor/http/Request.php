<?php

namespace Vendor\Http;

class Request
{
    private $methodList = ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];

    private $method;
    private $params = [];

    public function __construct()
    {
        $this->method = $this->getMethod(REQUEST_METHOD);
        $this->params = $this->getParams();
    }

    private function getMethod($method)
    {
        foreach($this->methodList as $key) {
            if($key == $method) {
                return $key;
            }
        }

        return false;
    }

    private function getParams()
    {
        switch($this->method) {
            case 'GET': return $_GET; break;
            case 'POST': return $_POST; break;
            case 'PATCH': return $_POST; break;
            case 'PUT': return $_POST; break;
            case 'DELETE': return $_GET; break;
        }

        return false;
    }

    public function all()
    {
        return $this->params;
    }

    public function has($key)
    {
        foreach($this->params as $valKey => $val) {
            if($valKey == $key) {
                return true;
            }
        }

        return false;
    }

    public function input($key)
    {
        if($this->has($key)) {
            return $this->params[$key];
        }

        return [];
    }
}