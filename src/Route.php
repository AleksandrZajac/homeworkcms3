<?php

namespace App;

class Route
{
    private $method;
    private $path;
    private $callback;

    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = $this->preparePath($path);
        $this->callback = $callback;
    }

    private function prepareCallback($callback)
    {
        if (is_string($callback)) {
            $callback = explode('@', $callback);
            return [new $callback[0], $callback[1]];
        } else {
            return $callback;
        }
    }

    private function preparePath($path)
    {
        $path = explode('/', $path);
        $path = array_filter($path);
        return '/' . implode('/', $path);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function match($method, $uri)
    {
        $uri = $this->preparePath($uri);
        $checkUri = preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $this->getPath()) . '$/', $uri);

        if ($this->method === $method && $checkUri) {
            return true;
        }
    }

    public function run($uri)
    {
        $params = array_diff(explode('/', $uri), explode('/', $this->getPath()));

        return call_user_func_array($this->prepareCallback($this->callback), $params);
    }
}
