<?php

function validateData() {
    if (mb_strlen($_POST['login']) < 6 || mb_strlen($_POST['login']) > 30) {
        $_SESSION['message'] = "Login must be between 6 and 30 characters";
        header("Location: /reg");
        exit;
    } elseif (mb_strlen($_POST['password']) < 8) {
        $_SESSION['message'] = "Password must be at least 8 characters";
        header("Location: /reg");
        exit;
    } elseif (mb_strlen($_POST['email']) < 4) {
        $_SESSION['message'] = "Email must be at least 4 characters";
        header("Location: /reg");
        exit;
    }
}

function userReg(array $newUserInfo) {
    $mysql = new mysqli('localhost', 'root', 12344321, 'db');
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

session_start();
$siteTitle = "Регистрация";
if (!empty($_POST)) {
    validateData();
    $newUserInfo = inputDataFormat();
    if (userReg($newUserInfo)) {
        $_SESSION['message'] = "User registered";
        header("Location: /auth");
        exit;
    } else {
        $_SESSION['message'] = "Username or email is already in use";
        header("Location: /reg");
        exit;
    }
}
require "views/reg.view.php";