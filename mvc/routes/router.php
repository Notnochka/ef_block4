<?php

namespace mvc\routes;

class Router {
    private array $routes;

    public function __construct(array $routes) {
        $this->routes = $routes;
    }

    public function dispatch(string $method, string $path): void {
        $path = parse_url($path, PHP_URL_PATH);
        
        if (isset($this->routes[$method][$path])) {
            [$controllerClass, $action] = $this->routes[$method][$path];
            
            if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
                $controller = new $controllerClass();
                $controller->$action();
                return;
            }
        }
        
        http_response_code(404);
        echo 'Not Found';
    }
}
