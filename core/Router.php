<?php

namespace Core;

class Router
{
    protected static $instance = null;

    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($uri, $callback)
    {
        $this->routes['GET'][$this->normalize($uri)] = $callback;
    }

    public function post($uri, $callback)
    {
        $this->routes['GET'][$this->normalize($uri)] = $callback;
    }

    public function dispatch($uri, $method)
    {
        $uri = $this->normalize(parse_url($uri, PHP_URL_PATH));
        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        // SUPPORT: closure, string "Controller@method", atau array [Controller::class, method]
        if (is_callable($callback)) {
            echo call_user_func($callback);
            return;
        }

        if (is_array($callback) && count($callback) === 2) {
            [$class, $method] = $callback;
            $instance = new $class();
            echo call_user_func([$instance, $method]);
            return;
        }

        if (is_string($callback)) {
            [$class, $method] = explode('@', $callback);
            $class = "App\\Controllers\\$class";
            $instance = new $class();
            echo call_user_func([$instance, $method]);
            return;
        }

        echo "Invalid route handler.";
    }

    protected function normalize($uri)
    {
        return trim($uri, '/') ?: '/';
    }

}
