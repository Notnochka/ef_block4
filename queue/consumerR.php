<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

echo "Consumer ожидает сообщения (Ctrl+C для выхода)\n";

$callback = function (AMQPMessage $msg) {
    $message = $msg->getBody();
    echo "Получено: {$message}\n";
    
    $logEntry = sprintf(
        "[%s] %s\n", 
        date('Y-m-d H:i:s'), 
        $message
    );
    file_put_contents(__DIR__ . '/rabbitmq.log', $logEntry, FILE_APPEND | LOCK_EX);
    
    echo "Записано в rabbitmq.log\n";
    
    $msg->ack();
    
    sleep(2);
    
    echo "Обработано: {$message}\n";
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

echo "Ожидание сообщений...\n";

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
