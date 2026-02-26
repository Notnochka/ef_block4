<?php
require 'vendor/autoload.php';

use React\Http\Browser;
use function React\Promise\all;

$loop = \React\EventLoop\Factory::create();
$browser = new Browser($loop);

$promises = [
    'API 1' => $browser->get('https://httpbin.org/json'),
    'API 2' => $browser->get('https://httpbin.org/uuid'),
    'API 3' => $browser->get('https://httpbin.org/user-agent'),
];

all($promises)->then(
    function (array $responses) {
        foreach ($responses as $name => $response) {
            echo "$name: Статус {$response->getStatusCode()}, длина: " . strlen($response->getBody()->getContents()) . "\n";
        }
        echo "Все запросы выполнены параллельно!\n";
    },
    function ($error) {
        echo "Ошибка: " . $error->getMessage() . "\n";
    }
);

$loop->run();
