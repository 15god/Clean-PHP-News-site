<?php

session_start();

use Core\Database;
use Core\App;

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

function autoLogin() {//переписать с $db
    if (isset($_COOKIE['userKey']) && empty($_SESSION['login'])) {
        $id = explode("_", $_COOKIE['userKey']);
        $db = App::resolve(Database::class);
        $result = $db->query("SELECT id, login, role_id FROM users WHERE id = :id", [
            ":id" => $id[0]
        ])->fetch();
        if ($_COOKIE['userKey'] === $result['id'] . '_' . md5($result['login'] . SALT)) {
            $_SESSION["login"] = $result["login"];
            $_SESSION["user_id"] = $result['id'];
            $_SESSION["role_id"] = $result['role_id'];
        }
    }
}

function flashMsg() {
    if (!empty($_SESSION['message'])) {
        if ($_SESSION['message'] == "User registered"):
            ?>
            <div class="alert alert-success mt-2" role="alert">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger mt-2" role="alert">
                <?php
                echo $msg = $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php
        endif;
    }
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
