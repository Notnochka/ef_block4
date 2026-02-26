<?php
namespace App\Routes;

class Router {
    public static function start() {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = explode('/', trim($uri, '/'));
        $controllerName = !empty($routes[0]) ? ucfirst($routes[0]) . 'Controller' : 'MainController';
        $actionName = !empty($routes[1]) ? 'action_' . $routes[1] : 'action_index';

        $controllerFile = __DIR__ . '/../controllers/' . strtolower($controllerName) . '.php';
        if (!file_exists($controllerFile)) {
            self::error404();
        }
        require_once $controllerFile;

        $controllerName = 'App\\Controllers\\' . $controllerName;
        $controller = new $controllerName();
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            self::error404();
        }
    }

    private static function error404() {
        http_response_code(404);
        require_once __DIR__ . '/../views/404.php';
        exit;
    }
}
