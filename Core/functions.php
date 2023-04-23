<?php

session_start();

define("SALT", "dflsk;flsdk125");

function inputDataFormat() {
    $userInfo = [
        "login" => htmlspecialchars(trim($_POST['login'])),
        "password" => md5(htmlspecialchars(trim($_POST['password'])) . SALT)
    ];
    if (!empty($_POST['email'])) {
        $userInfo['email'] = htmlspecialchars(trim($_POST['email']));
        filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    }
    return $userInfo;
}

function autoLogin() {
    if (isset($_COOKIE['userKey']) && empty($_SESSION['login'])) {
        $id = explode("_", $_COOKIE['userKey']);
        $mysql = new mysqli('localhost', 'root', 12344321, 'db');
        $result = mysqli_query($mysql, 'SELECT * FROM `users` WHERE `id` = "' . $id[0] . '"');
        $resultArray = mysqli_fetch_assoc($result);
        $mysql->close();
        if ($_COOKIE['userKey'] === $resultArray['id'] . '_' . md5($resultArray['login'] . SALT)) {
            $_SESSION["login"] = $resultArray["login"];
            $_SESSION["user_id"] = $resultArray['id'];
            $_SESSION["role_id"] = $resultArray['role_id'];
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
// CRUD, profile, news
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
            $path = base_path($defaultPath . 'source.jpg');
            $imagick = new Imagick($path);
            $imagick->cropThumbnailImage($sizes[$size], $sizes[$size], Imagick::FILTER_LANCZOS);
            $imagick->writeImage(base_path($defaultPath . $size . '.jpg'));
            $imagick->clear();
            return $defaultPath . $size . '.jpg';
        }
//    } elseif ($type == 'CRUD') {
//        $path = $post;
//        $imagick = new Imagick($path);
//        $imagick->cropThumbnailImage($sizes[$size], $sizes[$size], Imagick::FILTER_LANCZOS);
//        $imagick->writeImage(base_path($defaultPath . $size . '.jpg'));
//        $imagick->clear();
//        return $defaultPath . $size . '.jpg';
    }
}

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

function base_path($path) {
    return BASE_PATH . $path;
}

function isSessionActive($status = 'notLogged') {
    if (!isset($_SESSION['user_id']) && $status == 'notLogged') {
        header("Location: /");
        exit;
    } elseif (isset($_SESSION['user_id']) && $status == 'logged') {
        header("Location: /");
        exit;
    } elseif ((!isset($_SESSION['user_id']) || $_SESSION['role_id'] == 1) && $status == 'onlyAdmin') {
        header("Location: /");
        exit;
    }
}

function view($path, $attributes = []){
    
    extract($attributes);
    require base_Path("views/" . $path);
}
