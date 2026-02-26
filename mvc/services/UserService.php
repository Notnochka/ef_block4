<?php
namespace mvc\services\UserService;

use mvc\models\UserRepository;

class UserService {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getUsers() {
        $users = $this->userRepository->findAll();
        
        usort($users, fn($a, $b) => strcmp($a['name'], $b['name']));
        
        return array_filter($users, fn($user) => !empty($user['name']));
    }
}
