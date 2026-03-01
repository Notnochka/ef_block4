<?php
require 'vendor/autoload.php';

use DI\ContainerBuilder;
use DI\Container;

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
