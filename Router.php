<?php

class Router {

    protected $routes = [];
    public $uri;
    public $method;
    
    public function __construct() {
        
        require "routes.php";
        $this->uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->method =$_SERVER['REQUEST_METHOD'];
        
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

    public function route() {

        foreach ($this->routes as $route) {
            if ($route['uri'] === $this->uri && $route['method'] === $this->method) {
                if (empty($route['action'])){
                    return require $route['controller'];
                }
                else {
                    $ClassName = $route['controller'];
                    $action = $route['action'];
                    require 'controllers/' . $ClassName . '.php';
                    (new $ClassName)->$action();
                }
            }
        }
    }
}
