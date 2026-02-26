<?php

namespace di\UserService;

class UserService {
    public function __construct(private UserRepositoryInterface $repository) {}

    public function getUsers(): array {
        return $this->repository->findAll();
    }
}

