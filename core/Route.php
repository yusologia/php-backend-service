<?php

namespace Core;

class Route
{
    public static function get($uri, $callback)
    {
        Router::getInstance()->get($uri, $callback);
    }

    public static function post($uri, $callback)
    {
        Router::getInstance()->post($uri, $callback);
    }
}
