<?php

use DI\Container;
use di\UserRepositoryInterface\UserRepositoryInterface;
use di\UserRepository\UserRepository;
use di\UserService\UserService;

class UserServiceProvider {
    public function register(Container $container): void {
        $container->set(UserRepositoryInterface::class, \DI\create(UserRepository::class));
        $container->set('UserService', \DI\autowire(UserService::class));
    }
}
