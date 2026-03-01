<?php
require '../vendor/autoload.php';

use mvc\routes\Router;

$routes = require '../routes/web.php';
$router = new Router($routes);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$router->dispatch($method, $uri);
