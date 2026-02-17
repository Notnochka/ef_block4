<?php
namespace services;

require_once __DIR__ . '/../models/User.php';

class UserService {
    public function __construct(private UserRepository $repository) {}
    
    public function getAll() {
        $userModel = new User();
        return $userModel->all();
    }

    public function getUsers(): array {
        $users = $this->repository->getAll();
        usort($users, fn($a, $b) => strcmp($a['name'], $b['name']));
        return $users;
    }
}
