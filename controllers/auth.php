<?php

function checkAuth(array $userInfo) {
    $mysql = new mysqli('localhost', 'root', 12344321, 'db');
    $result = mysqli_query($mysql, 'SELECT * FROM `users` WHERE
    `login` = "' . $userInfo['login'] . '" AND
    `password` = "' . $userInfo['password'] . '"');
    if (mysqli_num_rows($result) !== 0) {
        $resultArray = mysqli_fetch_assoc($result);
        $_SESSION["login"] = $userInfo["login"];
        $_SESSION["user_id"] = $resultArray['id'];
        $_SESSION["role_id"] = $resultArray['role_id'];
        mysqli_query($mysql, 'UPDATE `users`
        SET `last_auth_date` = "' . date('Y-m-d H:i:s') . '"
        WHERE `login` = "' . $userInfo['login'] . '"');
        return true;
    }
    return false;
}

session_start();
isSessionActive('logged');
$siteTitle = "Вход";
if (!empty($_POST)) {
    $userInfo = inputDataFormat();
    if (checkAuth($userInfo)) {
        if (isset($_POST['cookieCheckBox'])) {
            $config = require "dbconfig.php";
            $db = new Database($config);
            $result = $db->query('SELECT id FROM users WHERE login = "' . $userInfo['login'] . '"')->fetch();
            setcookie('userKey', $result['id'] . '_' . md5($userInfo['login'] . SALT), time() + 3600, '/');
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