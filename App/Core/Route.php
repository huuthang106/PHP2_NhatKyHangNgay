<?php

namespace App\Core;

class Route
{
    protected array $routes;
    public function register(string $route, callable|array $action): self
    {
        // var_dump($route);
        $this->routes[$route] = $action;
        // var_dump($this->routes);
        // echo 'I am route register';
        return $this;
    }

    public function resolve(string $requesUrl)
    {
        $route = explode('?', $requesUrl)[0];
        $action = $this->routes[$route] ?? null;
        if (!$action) {
            // throw new RouteNoFoundException();
            echo 'not found';
        }
        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $class = new $class();
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
    }
}
