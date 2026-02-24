<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('task_queue', false, true, false, false);

echo "URL: " . $argv[1] ?? 'Hello World!' . PHP_EOL;

$msg = new AMQPMessage($argv[1] ?? 'Hello World!', [
    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
]);

$channel->basic_publish($msg, '', 'task_queue');

echo "Отправлено в task_queue: " . $msg->getBody() . PHP_EOL;

$channel->close();
$connection->close();
