<?php
require 'vendor/autoload.php';

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    'UserServiceProvider' => \DI\create(UserServiceProvider::class),
]);
$container = $builder->build();

