<?php

declare(strict_types=1);

use DI\Container;

class UserServiceProvider {
    
    public function register(Container $container): void {
        $container->set(UserRepositoryInterface::class, \UserRepository::class);
        
        $container->set('UserService', function (Container $c) {
            return new UserService($c->get(UserRepositoryInterface::class));
        });
    }
}
