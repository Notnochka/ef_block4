<?php

use DI\ContainerBuilder;
use mvc\models\UserRepository;
use mvc\services\UserService;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/UserRepository.php';
require_once __DIR__ . '/../services/UserService.php';

$builder = new ContainerBuilder();

// Explicit definitions to make wiring clear and reliable
$builder->addDefinitions([
    UserRepository::class => \DI\create(UserRepository::class),
    UserService::class => \DI\autowire(UserService::class),
]);

return $builder->build();

