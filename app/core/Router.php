<?php

class Router {
    private array $routes = [];
    private AuthHelper $authHelper;

    public function __construct() {
        $this->authHelper = new AuthHelper();
    }

    public function get(string $path, $handler) {
        $this->routes["GET"][$path] = $handler;
    }

    public function post(string $path, $handler) {
        $this->routes["POST"][$path] = $handler;
    }

    public function resolve(string $url, string $method) {
        $url = explode("?", $url)[0];

        if ($this->authHelper->isLoggedIn() && in_array($url, NO_SESSION_PAGES)) {
            header("Location: " . DEFAULT_PAGE); 
            exit();
        }

        if (!$this->authHelper->isLoggedIn() && !in_array($url, PUBLIC_PAGES)) {
            header("Location: login"); 
            exit();
        }

        $handler = $this->routes[$method][$url] ?? null;

        if (!$handler) {
            throw new RequestException(404, "Halaman tidak ditemukan.");
        }

        $requestData = [];

        if ($method === "GET") {
            $requestData = $_GET;
        } elseif ($method === "POST") {
            $requestData = array_merge($_GET, $_POST);
        }

        // Immediately call anonymous functions (e.g. on auth pages)
        if (is_callable($handler)) {
            $reflection = new ReflectionFunction($handler);

            if ($reflection->getNumberOfParameters() > 0) {
                return call_user_func($handler, $requestData);
            } else {
                return call_user_func($handler);
            }
        }

        if (is_string($handler)) {
            [$class, $methodName] = explode("::", $handler);
            $controller = new $class();
            $reflection = new ReflectionMethod($controller, $methodName);

            if ($reflection->getNumberOfParameters() > 0) {
                return $controller->$methodName($requestData);
            } else {
                return $controller->$methodName();
            }
        }
    }
}
