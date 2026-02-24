<?php
use Swoole\Timer;

$timerId = Timer::tick(5000, function () {  // Каждые 5 секунд (5000 мс)
    echo "[" . date('Y-m-d H:i:s') . "] Сервер работает, пользователей онлайн: " . rand(10, 100) . PHP_EOL;
});

echo "Сервер с таймером запущен." . PHP_EOL;
