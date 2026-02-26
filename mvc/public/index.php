<?php
require 'vendor/autoload.php';
require_once '../routes/web.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($path === '/users') {
    $controller = new controllers\UsersController();
    $controller->index();
} else {
    http_response_code(404);
    echo 'Not Found';
}
