<?php

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->useAutowiring(true);

$container = $builder->build();

$provider = new UserServiceProvider();
$provider->register($container);

return $container;
