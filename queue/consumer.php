<?php
require 'vendor/autoload.php';

use Predis\Client;

$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

echo "Consumer: Ожидание задач (Ctrl+C для выхода)...\n";

while (true) {
    $result = $redis->brpop('tasks', 0);
    
    if (!$result) continue;
    
    $taskJson = $result[1];
    $task = json_decode($taskJson, true);
    
    if (isset($task['quit'])) {
        echo "Получено QUIT, завершение...\n";
        break;
    }
    
    echo "[" . date('H:i:s') . "] Обработка: {$task['message']}\n";

    sleep(rand(1, 3));
    
    echo "Задача {$task['id']} выполнена\n";
}
