<?php
require_once 'vendor/autoload.php';

$container = require 'config/container.php';
$service = $container->get(UserService::class);
print_r($service->getUsers());
