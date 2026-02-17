<?php

namespace mvc\models\User;

class User {
    private $pdo;

    public function __construct() {
        $config = require __DIR__ . '/../config/database.php';
        $this->pdo = new \PDO($config['dsn'], $config['user'], $config['pass']);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function all() {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private static function getConnection() {
        $config = require __DIR__ . '/../config/database.php';
        $pdo = new \PDO($config['dsn'], $config['user'], $config['pass']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function getAll() {
        $pdo = self::getConnection();
        $stmt = $pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
