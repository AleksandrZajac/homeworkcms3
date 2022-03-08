<?php

namespace App;

use App\Exception\NotFoundException;

class Router
{   
    public $routes = [];

    public function get($uri, $method)
    {
        $this->routes[] = new Route('GET', $uri, $method);
    }

    public function post($uri, $method)
    {
        $this->routes[] = new Route('POST', $uri, $method);
    }

    public function findRoute($method, $url)
    {
        foreach ($this->routes as $route) {

            if ($route->match($method, $url)) {
                return $route;
            }
        }

        throw new NotFoundException('Нет такого маршрута ' . $url);
    }

    public function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $route = $this->findRoute($method, $url);
    
        if ($route) {
            return $route->run($url);
        } 
    }
}
