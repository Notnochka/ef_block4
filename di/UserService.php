<?php

namespace di;

use di\UserRepositoryInterface;

class UserService {
    public function __construct(private UserRepositoryInterface $repository) {}

    public function getUsers(): array {
        return $this->repository->findAll();
    }
}

