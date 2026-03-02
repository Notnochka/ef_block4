<?php

namespace mvc\models;

use PDO;

class UserRepository {
    private $pdo;

    public function __construct() {
        $config = require __DIR__ . '/../config/database.php';
        $this->pdo = new PDO($config['dsn'], $config['user'], $config['pass']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec('SET NAMES utf8');
    }

    public function findAll() {
        $stmt = $this->pdo->query('SELECT id, name, email, created_at FROM users ORDER BY id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}