<?php
namespace mvc\controllers\UserController;

$container = require __DIR__ . '/../config/container.php';
$service = $container->get(UserService::class);
$users = $service->getUsers();
require_once __DIR__ . '/../views/users.php';

class UserController {
    public function index() {
        $service = new UserService(new UserRepository());
        $users = $service->getUsers();
        require_once __DIR__ . '/../views/users.php';
    }
}
