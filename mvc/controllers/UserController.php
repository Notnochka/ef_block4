<?php
namespace mvc\controllers\UserController;

use mvc\services\UserService;
use mvc\models\UserRepository;

class UserController {
    private $userService;

    public function action_index() {
        $repository = new UserRepository();
        $service = new UserService($repository);
        $users = $service->getUsers();
        require_once __DIR__ . '/../views/users.php';
    }
}
