<?php

namespace di\UserService;

use di\UserRepositoryInterface\UserRepositoryInterface;

class UserService {
    public function __construct(private UserRepositoryInterface $repository) {}

    public function getUsers(): array {
        return $this->repository->findAll();
    }
}

