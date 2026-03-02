<?php
require 'vendor/autoload.php';

require_once __DIR__ . '/UserServiceProvider.php';
require_once __DIR__ . '/UserRepositoryInterface.php';
require_once __DIR__ . '/UserRepository.php';
require_once __DIR__ . '/UserService.php';

use DI\ContainerBuilder;
use DI\Container;
use di\UserServiceProvider;

function createContainer(): Container {
    $builder = new ContainerBuilder();
    $builder->addDefinitions([
        'UserServiceProvider' => \DI\create(UserServiceProvider::class),
    ]);
    $container = $builder->build();
    
    $provider = $container->get('UserServiceProvider');
    $provider->register($container);
    
    return $container;
}

$container = createContainer();
