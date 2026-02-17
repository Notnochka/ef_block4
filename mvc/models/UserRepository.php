<?php

namespace mvc\models\UserRepository;

class UserRepository {
    private static ?PDO $pdo = null;

    private static function getConnection(): PDO {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../config/database.php';
            self::$pdo = new PDO(
                $config['dsn'], 
                $config['username'], 
                $config['password'], 
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        return self::$pdo;
    }

    public function getAll(): array {
        $pdo = self::getConnection();
        $stmt = $pdo->query('SELECT id, name, email FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}