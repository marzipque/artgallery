<?php

namespace App\Core;

use Exception;

/**
 * Класс-маршрутизатор
 * 
 * Этот класс позволяет добавлять маршруты, определять подходящий маршрут на основе входящих запросов
 * и вызывать соответствующий контроллер и действие для обработки этих запросов
 */
class Router
{
    protected $routes = [];

    /**
     * Добавляет новый маршрут
     *
     * @param string $method HTTP-метод (GET, POST и т.д.)
     * @param string $path Путь маршрута
     * @param string $controller Имя контроллера, который будет обрабатывать запрос
     * @param string $action Имя метода контроллера, который будет вызван
     */
    public function addRoute($method, $path, $controller, $action): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    /**
     * Обрабатывает входящий запрос и начинает поиск соответствующего маршрута
     */
    public function resolve(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = rtrim($_SERVER['REQUEST_URI'], '/');

        foreach ($this->routes as $route) {
            if (($route['method'] === $requestMethod && preg_match($this->getRegex($route['path']), $requestUri, $matches))) {
                array_shift($matches);
                $this->dispatch($route['controller'], $route['action'], $matches);
                return;
            }
        }

        http_response_code(404);
        require_once "app/views/404.php";
    }


    /**
     * Преобразует путь маршрута в регулярное выражение
     *
     * @param string $path Путь маршрута
     * 
     * @return string Регулярное выражение для сопоставления
     */
    private function getRegex($path): string
    {
        return '#^' . preg_replace('/{(\w+)}/', '([^/]+)', $path) . '$#';
    }

    /**
     * Загружает указанный контроллер и вызывает требуемый метод
     *
     * @param string $controllerName Имя контроллера
     * @param string $action Имя метода, который будет вызван
     * @param array $params Параметры, передаваемые в метод
     * 
     * @throws Exception Если контроллер или метод не найдены
     */
    private function dispatch($controllerName, $action, $params): void
    {
        $controllerFile = "app/controllers/$controllerName.php";
        $controllerClass = "App\\Controllers\\$controllerName";

        if (file_exists($controllerFile)) {
            include $controllerFile;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            throw new Exception("Метод не найден: $action в $controllerClass");
        }

        call_user_func_array([$controller, $action], $params);
    }
}
