<?php

namespace Vendor\Http;

use Vendor\Http\Request;

class Router
{
    /**
     * @var array
     * routes : [prefix => [controller, type, method, hasParams]]
     */
    private static $routes = [];
    private $isApi = false;

    public function __construct($isApi = false)
    {
        $this->isApi = $isApi;
    }

    private function hasParams($prefix, $routeData)
    {
        if($routeData['hasParams']) {
            $exp = explode('/', $prefix);
            if(count($exp) > 3 && $exp[3] != null && $exp[3] != '') {
                return $exp[3];
            } else {
                throw new \Exception('Route parameter options cannot be null');
            }
        }

        return null;
    }

    public function add($prefix, $methodType = 'GET', $options)
    {
        $arr = explode('@', $options);

        $prefix = $this->isApi ? '/api' . $prefix : $prefix;

        if($regex = preg_match('/{(?P<params>\w+)}/', $prefix, $matches)) {
            $prefix = str_replace('/' . $matches[0], null, $prefix);
        }

        Router::$routes[$prefix . '@' . $methodType] = [
            'controller' => $arr[0],
            'type' => $methodType == 'SHOW' ? 'GET': $methodType,
            'method' => $arr[1],
            'hasParams' => $regex
        ];
    }

    public function has($prefix)
    {
        foreach(Router::$routes as $key => $route) {
            if(!$route['hasParams']) {
                if($key == $prefix . '@' . REQUEST_METHOD) {
                    return $route;
                }
            } else {
                $exp = explode('/', $prefix);

                if(REQUEST_METHOD == 'GET' && $key == '/' . $exp[1] . '/' . $exp[2] . '@SHOW') {
                    return $route;
                } else if($key == '/' . $exp[1] . '/' . $exp[2] . '@' . REQUEST_METHOD) {
                    return $route;
                }
            }
        }

        return false;
    }

    public function get($prefix, $options)
    {
        $this->add($prefix, 'GET', $options);
    }

    public function show($prefix, $options)
    {
        $this->add($prefix, 'SHOW', $options);
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
        $this->show($prefix . '/{id}', $controller . '@show');
        $this->patch($prefix . '/{id}', $controller . '@update');
        $this->delete($prefix . '/{id}', $controller . '@destroy');
    }

    public function route($prefix)
    {
        if($routeData = $this->has($prefix)) {
            $params = $this->hasParams($prefix, $routeData);
            $controller = $routeData['controller'];
            $method = $routeData['method'];
            $classPath = CONTROLLER_PATH . $controller;
            if(class_exists($classPath)) {
                $class = new $classPath();
                if(method_exists($class, $method)) {
                    if($routeData['type'] == 'GET') {
                        if($params != null && $params) {
                            $class->$method($params);
                        } else {
                            $class->$method();
                        }
                    } else {
                        if($params != null && $params) {
                            $class->$method($params, new Request());
                        } else {
                            $class->$method(new Request());
                        }
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