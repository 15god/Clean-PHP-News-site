<?php

session_start();

define("SALT", "dflsk;flsdk125");

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($path, $attributes = []){
    
    extract($attributes);
    require base_Path("views/" . $path);
}

function redirect($path){
    
    header("Location: $path");
    exit();
}

function old($key, $deafult = ""){
    
    return Core\Session::get('old')[$key] ?? $deafult;
}

function getImage($type, string $size = 'small'): string {
// profile, news
    $sizes = [
        'big' => 300,
        'medium' => 150,
        'small' => 60
    ];
    if (array_key_exists($size, $sizes) && $type == 'profile') {
        $defaultPath = 'uploads/' . 'user' . $_SESSION['user_id'];
        if (!file_exists($defaultPath . 'source.jpg')) {
            return 'uploads/defaultimg' . $size . ".jpg";
        } elseif (file_exists($defaultPath . $size . '.jpg')) {
            return $defaultPath . $size . '.jpg';
        } else {
            $path = base_path('public/' . $defaultPath . 'source.jpg');
            $imagick = new Imagick($path);
            $imagick->cropThumbnailImage($sizes[$size], $sizes[$size], Imagick::FILTER_LANCZOS);
            $imagick->writeImage(base_path('public/' . $defaultPath . $size . '.jpg'));
            $imagick->clear();
            return $defaultPath . $size . '.jpg';
        }
    }
}
