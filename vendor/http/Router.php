<?php

namespace Vendor\Http;

use Vendor\Http\Request;

class Router
{
    private $routes = [];

    public function add($prefix, $methodType = 'GET', $options)
    {
        $arr = explode('@', $options);

        $this->routes[$prefix . '@' . $methodType] = [
            'controller' => $arr[0],
            'type' => $methodType,
            'method' => $arr[1]
        ];
    }

    public function has($prefix)
    {
        foreach($this->routes as $key => $route) {
            if($key == $prefix . '@' . REQUEST_METHOD) {
                return true;
            }
        }

        return false;
    }

    public function get($prefix, $options)
    {
        $this->add($prefix, 'GET', $options);
    }

    public function post($prefix, $options)
    {
        $this->add($prefix, 'POST', $options);
    }

    public function patch($prefix, $options)
    {
        $this->add($prefix, 'PATCH', $options);
    }

    public function put($prefix, $options)
    {
        $this->add($prefix, 'PUT', $options);
    }

    public function delete($prefix, $options)
    {
        $this->add($prefix, 'DELETE', $options);
    }

    public function resource($prefix, $controller)
    {
        $this->get($prefix, $controller . '@index');
        $this->post($prefix, $controller . '@store');
        $this->patch($prefix, $controller . '@update');
        $this->delete($prefix, $controller . '@destroy');
    }

    public function route($prefix)
    {
        if($this->has($prefix)) {
            $routeData = $this->routes[$prefix . '@' . REQUEST_METHOD];
            $controller = $routeData['controller'];
            $method = $routeData['method'];
            $classPath = CONTROLLER_PATH . $controller;
            if(class_exists($classPath)) {
                $class = new $classPath();
                if(method_exists($class, $method)) {
                    if($routeData['type'] == 'GET') {
                        $class->$method();
                    } else {
                        $class->$method(new Request);
                    }
                } else {
                    throw new \Exception('Method ' . $method . ' doesn\'t exists');
                }
            } else {
                throw new \Exception('Class ' . $classPath . ' doesn\'t exists');
            }
        } else {
            throw new \Exception('Invalid route prefix or route method');
        }
    }
}