<?php

define('BASE_PATH', __DIR__ . '/../');

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function($class){
    
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    
    require base_path("{$class}.php");
});
require base_path("bootstrap.php");
require base_path("Core/Router.php");

autoLogin();

$router = new Router();
$router->route();
//доделать wyswig, навести порядок с альбомом и крудом
