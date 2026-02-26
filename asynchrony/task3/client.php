<?php
require 'vendor/autoload.php';

use React\EventLoop\Loop;
use React\Buzz\Browser;

$loop = Loop::get();

$browser = new Browser($loop);

$browser->get('https://jsonplaceholder.typicode.com/users/1')
    ->then(function (\Psr\Http\Message\ResponseInterface $response) {
        $data = json_decode($response->getBody()->getContents(), true);
        echo "ID: " . $data['id'] . ", Имя: " . $data['name'] . PHP_EOL;
        echo "Email: " . $data['email'] . PHP_EOL;
    })
    ->otherwise(function (\Throwable $e) {
        echo "Ошибка: " . $e->getMessage() . PHP_EOL;
    });

$loop->run();
