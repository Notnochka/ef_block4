<?php

namespace mvc\models\UserRepository;

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/UserRepositoryInterface.php';

class UserRepository implements UserRepositoryInterface {
    private static ?PDO $pdo = null;

    private static function getConnection(): PDO {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/database.php';
            self::$pdo = new PDO($config['dsn'], $config['username'], $config['password']);
        }
        return self::$pdo;
    }

    public function getAll(): array {
        $stmt = self::getConnection()->query('SELECT id, name, email FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}