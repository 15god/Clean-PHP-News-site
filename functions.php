<?php
require_once "dbconfig.php";

define("SALT", "dflsk;flsdk125");

function checkAuth(array $userInfo): bool { // Auth check
    $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($mysql, 'SELECT * FROM `users` WHERE
    `login` = "' . $userInfo['login'] . '" AND
    `password` = "' . $userInfo['password'] . '"');
    if (mysqli_num_rows($result) !== 0) {
        $resultArray = mysqli_fetch_assoc($result);
        $_SESSION["login"] = $userInfo["login"];
        $_SESSION["userid"] = $resultArray['id'];
        mysqli_query($mysql, 'UPDATE `users`
        SET `last_auth_date` = "' . date('Y-m-d H:i:s') . '"
        WHERE `login` = "' . $userInfo['login'] . '"');
        $mysql->close();
        return true;
    }
    $mysql->close();
    return false;
}

function userReg(array $newUserInfo): bool { // New user registration
    $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $result = mysqli_query($mysql, 'SELECT `login`, `email` FROM `users` WHERE
    `login` = "' . $newUserInfo['login'] . '" OR
    `email` = "' . $newUserInfo['email'] . '"');
    if (mysqli_num_rows($result) !== 0) {
        $mysql->close();
        return false;
    }
    mysqli_query($mysql, 'INSERT INTO `users` (`login`, `password`, `email`)
    VALUES("' . $newUserInfo['login'] . '",
            "' . $newUserInfo['password'] . '",
            "' . $newUserInfo['email'] . '")');
    $mysql->close();
    return true;
}

function inputDataFormat() { // Standartdizing data from post
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

function autoLogin() { // Cookie login check
    if (isset($_COOKIE['userKey'])) {
        $id = explode("_", $_COOKIE['userKey']);
        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($mysql, 'SELECT `id`, `login` FROM `users` WHERE `id` = "' . $id[0] . '"');
        $resultArray = mysqli_fetch_assoc($result);
        if ($_COOKIE['userKey'] === $resultArray['id'] . '_' . md5($resultArray['login'] . SALT)) {
            $_SESSION['user'] = $resultArray['login'];
            $mysql->close();
        }
    }
}

function validateData() {
    if (mb_strlen($_POST['login']) < 6 || mb_strlen($_POST['login']) > 30) {
        $_SESSION['message'] = "Login must be between 6 and 30 characters";
        header("Location: reg.php");
        exit;
    } elseif (mb_strlen($_POST['password']) < 8) {
        $_SESSION['message'] = "Password must be at least 8 characters";
        header("Location: reg.php");
        exit;
    } elseif (mb_strlen($_POST['email']) < 4) {
        $_SESSION['message'] = "Email must be at least 4 characters";
        header("Location: reg.php");
        exit;
    }
}
?>

<?php

function flashMsg() {
    if (!empty($_SESSION['message'])) {
        if ($_SESSION['message'] == "User registered"):
            ?>
            <div class="alert alert-success mt-2" role="alert">
                <?php
                echo $msg = $_SESSION['message'];
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

function getImage(string $size = 'small'): string {
    
    $sizes = [
        'big' => 300,
        'medium' => 150,
        'small' => 60
    ];
    if(array_key_exists($size, $sizes)) {
        $defaultPath = 'uploads/' . 'user' . $_SESSION['userid'];
        if (!file_exists($defaultPath . 'source.jpg')) {
            return 'uploads/defaultimg' . $size . ".jpg";
        }
        else if (file_exists($defaultPath . $size . '.jpg')) {
            return $defaultPath . $size . '.jpg';
        }
        $path = $_SERVER['DOCUMENT_ROOT'] . "/" . $defaultPath . 'source.jpg';
        $imagick = new Imagick($path);
        $imagick->cropThumbnailImage($sizes[$size], $sizes[$size], Imagick::FILTER_LANCZOS);
        $imagick->writeImage($_SERVER['DOCUMENT_ROOT'] . "/" . $defaultPath . $size . '.jpg');
        $imagick->clear();
        return $defaultPath . $size . '.jpg';
    }
    return '#';
}
