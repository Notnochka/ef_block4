<?php
namespace mvc\controllers\UsersController;

use services\UserService;

class UsersController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService();
    }

    public function index() {
        $users = $this->userService->getAll();
        require_once __DIR__ . '/../views/users/index.php';
    }
}
