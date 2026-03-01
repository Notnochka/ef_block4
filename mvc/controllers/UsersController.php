<?php
namespace mvc\controllers\UsersController;

use mvc\services\UserService\UserService;
use mvc\models\UserRepository\UserRepository;
use mvc\views\UserView;

class UsersController {
    private $userService;
    private $view;

    public function __construct() {
        $userRepository = new UserRepository();
        $this->userService = new UserService($userRepository);
        $this->view = new UserView();
    }

    public function action_index() {
        $users = $this->userService->getUsers();
        $this->view->render('users/index.php', ['users' => $users]);
    }
}

