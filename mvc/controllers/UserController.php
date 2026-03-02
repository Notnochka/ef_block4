<?php
namespace mvc\controllers;

use mvc\services\UserService\UserService;
use mvc\models\UserRepository\UserRepository;

class UserController {
    private $userService;

    public function action_index() {
        $repository = new UserRepository();
        $service = new UserService($repository);
        $users = $service->getUsers();
        require_once __DIR__ . '/../views/users.php';
    }
}
