<?php
session_start();
$siteTitle = "Вход";
if (!empty($_POST)) {
    $userInfo = inputDataFormat();
    if (checkAuth($userInfo)) {
        if (isset($_POST['cookieCheckBox'])) {
            $mysql = new mysqli('localhost', 'root', 12344321, 'db');
            $result = mysqli_query($mysql,
                    'SELECT `id` FROM `users` WHERE `login` = "' . $userInfo['login'] . '"');
            $resultArray = mysqli_fetch_assoc($result);
            setcookie('userKey', $resultArray['id'] . '_' . md5($userInfo['login'] . SALT), time() + 3600, '/');
            $mysql->close;
        }
        header("Location: /");
        exit;
    } else {
        $_SESSION['message'] = "Wrong login or password";
        header("Location: /auth");
        exit;
    }
}
require "views/auth.view.php";