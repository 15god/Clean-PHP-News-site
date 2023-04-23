<?php

class Router {

    protected $routes = [];
    private $uri;
    private $method;
    
    public function __construct() {
        
        require base_path("routes.php");
        $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        
    }

    public function add($uri, $controller, $method, $action) {

        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "action" => $action
        ];
    }

    public function get($uri, $controller, $action = '') {

        $this->add($uri, $controller, "GET", $action);
    }

    public function post($uri, $controller, $action = '') {

        $this->add($uri, $controller, "POST", $action);
    }
    
    public function delete($uri, $controller, $action = '') {

        $this->add($uri, $controller, "DELETE", $action);
    }
    
    public function put($uri, $controller, $action = '') {

        $this->add($uri, $controller, "PUT", $action);
    }
    public function patch($uri, $controller, $action = '') {

        $this->add($uri, $controller, "PATCH", $action);
    }

    public function route() {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $this->uri && $route['method'] === strtoupper($this->method)) {
                if (empty($route['action'])){
                    return require base_path('controllers/' . $route['controller']);
                }
                else {
                    $ClassName = $route['controller'];
                    $action = $route['action'];
                    require base_path('controllers/' . $ClassName . '.php');
                    (new $ClassName)->$action();
                }
            }
        }
    }
}
