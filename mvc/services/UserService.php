<?php
namespace mvc\services\UserService;

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/UserRepository.php';

class UserService {
    public function __construct(private UserRepositoryInterface $repository) {}
    
    public function getAll() {
        $userModel = new User();
        return $userModel->all();
    }

    public function getUsers(): array {
        return $this->repository->getAll();
    }
}
