<?php

require_once __DIR__ . '/../vendor/autoload.php'; // autoload composer
require_once __DIR__ . '/../routes/web.php';

use Core\Router;

$router = Router::getInstance();
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
