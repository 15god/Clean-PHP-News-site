<?php

use Core\Session;
use Core\Authenticator;
use Core\ValidationException;

define('BASE_PATH', __DIR__ . '/../');

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {

    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});
require base_path("bootstrap.php");
require base_path("Core/Router.php");

Authenticator::autoLogin();

$router = new Router();
try {
    $router->route();
} catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);
    return redirect($router->previous_URL());
}
Session::unflash();
