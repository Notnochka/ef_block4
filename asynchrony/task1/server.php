<?php
use OpenSwoole\Http\Server as HttpServer;
use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;

$server = new HttpServer("127.0.0.1", 9501);

$server->on("start", function (HttpServer $server) {
    echo "Swoole HTTP сервер запущен: http://localhost:9501" . PHP_EOL;
});

$server->on("request", function (Request $request, Response $response) {
    $response->header("Content-Type", "text/html; charset=utf-8");
    
    if ($request->server['request_uri'] === '/') {
        $response->end("<h1>Swoole сервер работает!</h1><p>Время: " . date('Y-m-d H:i:s') . "</p>");
    } else {
        $response->status(404);
        $response->end("404 Not Found");
    }
});

$server->start();
