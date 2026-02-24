<?php
require 'vendor/autoload.php';

use React\EventLoop\Loop;
use Clue\React\Buzz\Browser;
use React\Promise\PromiseInterface;

$loop = Loop::get();
$browser = new Browser($loop);

$urls = [
    'https://jsonplaceholder.typicode.com/users/1',
    'https://jsonplaceholder.typicode.com/posts/1', 
    'https://jsonplaceholder.typicode.com/comments/1',
    'https://httpbin.org/delay/1',
];

$startTime = microtime(true);

echo "Запуск " . count($urls) . " параллельных запросов...\n";

$promises = array_map(fn($url) => $browser->get($url), $urls);

PromiseInterface::all($promises)
    ->then(function (array $responses) use ($startTime) {
        $endTime = microtime(true);
        echo "\n Все запросы выполнены за " . round(($endTime - $startTime) * 1000, 2) . "мс\n";
        
        foreach ($responses as $i => $response) {
            $url = $urls[$i];
            $status = $response->getStatusCode();
            $size = strlen($response->getBody()->getContents());
            echo "$url [$status] {$size}б\n";
        }
    })
    ->otherwise(function ($e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    });

$loop->run();
