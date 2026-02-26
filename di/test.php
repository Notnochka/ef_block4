<?php

require 'vendor/autoload.php';

$container->get('UserServiceProvider');
$service = $container->get('UserService');
print_r($service->getUsers());
