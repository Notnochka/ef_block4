<?php

use mvc\controllers\UsersController\UsersController;

return [
    'GET' => [
        '/users' => [UsersController::class, 'action_index'],
    ],
];
