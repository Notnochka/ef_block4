<?php
require_once 'vendor/autoload.php';

use mvc\services\UserService;

$container = require 'config/container.php';
$service = $container->get(UserService::class);
print_r($service->getUsers());
