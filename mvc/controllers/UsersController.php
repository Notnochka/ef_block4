<?php
namespace mvc\controllers\UsersController;

use mvc\services\UserService;
use mvc\views\UserView;

class UsersController {
    private $userService;
    private $view;

    public function __construct() {
        $this->userService = new UserService();
        $this->view = new UserView();
    }

    public function action_index() {
        $users = $this->userService->getUsersList();
        $this->view->render('users/index.php', ['users' => $users]);
    }
}

