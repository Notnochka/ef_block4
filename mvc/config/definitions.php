<?php

use mvc\models\UserRepositoryInterface;
use mvc\models\UserRepository;
use mvc\services\UserService;

return [
    'UserService' => \UserService::class,
    UserRepository::class => \UserRepository::class,
    UserRepositoryInterface::class => \UserRepositoryInterface::class,
];
