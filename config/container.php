<?php

use DI\ContainerBuilder;

$builder = new ContainerBuilder();
$builder->enableCompilation(__DIR__ . '/../var/cache');  // Кэш для продакшена
$builder->useAutowiring(true);  // Авто DI по конструкторам
$container = $builder->build();

return $container;
