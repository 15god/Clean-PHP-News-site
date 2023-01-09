<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/auth' => 'controllers/auth.php',
    '/reg' => 'controllers/reg.php',
    '/profile' => 'controllers/profile.php',
    '/album' => 'controllers/album.php',
    '/logout' => 'controllers/logout.php'
];

if(array_key_exists($uri, $routes)) {
    require $routes[$uri];
}