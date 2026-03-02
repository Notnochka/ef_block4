<?php
namespace mvc\models;

use PDO;

class User {
    private static $pdo = null;

    public static function getPdo() {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/database.php';
            self::$pdo = new PDO($config['dsn'], $config['user'], $config['pass']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->exec('SET NAMES utf8');
        }
        return self::$pdo;
    }

    public static function getAll() {
        $pdo = self::$pdo ?? self::getPdo();
        $stmt = $pdo->query('SELECT id, name, email, created_at FROM users ORDER BY id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function create(array $data) {
        $pdo = self::getPdo();
        $stmt = $pdo->prepare('INSERT INTO users (name, email) VALUES (?, ?)');
        $stmt->execute([$data['name'], $data['email']]);
        return self::$pdo->lastInsertId();
    }
}

