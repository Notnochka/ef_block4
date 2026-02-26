<?php
require 'vendor/autoload.php';

use Predis\Client;

$redis = new Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

echo "Producer: Добавляем задачи...\n";

for ($i = 1; $i <= 3; $i++) {
    $task = json_encode([
        'id' => $i,
        'message' => "Задача #$i: Обработать данные",
        'time' => date('Y-m-d H:i:s')
    ]);
    
    $redis->rpush('tasks', $task);
    echo "Добавлена задача #$i\n";
}

$redis->rpush('tasks', json_encode(['quit' => true]));
echo "Послано QUIT сообщение\n";
