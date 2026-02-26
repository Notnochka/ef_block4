<?php

use DI\Container;

class UserServiceProvider {
    public function register(Container $container): void {
        $container->set(UserRepositoryInterface::class, \DI\create(UserRepository::class));
        $container->set('UserService', \DI\autowire(UserService::class));
    }
}
