<?php

use Core\Middleware\Middleware;

class Router {

    protected $routes = [];
    private $uri;
    private $method;

    public function __construct() {

        require base_path("routes.php");
        $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->method = strtoupper($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
    }

    public function add($uri, $controller, $method, $action) {

        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => $action,
            "middleware" => null
        ];

        return $this;
    }

    public function get($uri, $controller, $action = '') {

        return $this->add($uri, $controller, "GET", $action);
    }

    public function post($uri, $controller, $action = '') {

        return $this->add($uri, $controller, "POST", $action);
    }

    public function delete($uri, $controller, $action = '') {

        return $this->add($uri, $controller, "DELETE", $action);
    }

    public function put($uri, $controller, $action = '') {

        return $this->add($uri, $controller, "PUT", $action);
    }

    public function patch($uri, $controller, $action = '') {

        return $this->add($uri, $controller, "PATCH", $action);
    }

    function previous_URL() {

        return $_SERVER['HTTP_REFERER'];
    }

    public function only($key) {

        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route() {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $this->uri && $route['method'] === strtoupper($this->method)) {

                Middleware::resolve($route['middleware']);

                if (empty($route['action'])) {
                    return require base_path('controllers/' . $route['controller']);
                } else {
                    $ClassName = $route['controller'];
                    $action = $route['action'];
                    require base_path('controllers/' . $ClassName . '.php');
                    (new $ClassName)->$action();
                }
            }
        }
    }

}
