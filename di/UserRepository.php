<?php

namespace di\UserRepository;
use di\UserRepositoryInterface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    public function findAll(): array {
        return [
            ['id' => 1, 'name' => 'Анна Смирнова'],
            ['id' => 2, 'name' => 'Дмитрий Козлов'],
        ];
    }
}

