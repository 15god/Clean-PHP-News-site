<?php

define("SALT", "dflsk;flsdk125");

function checkAuth(array $userInfo): bool { // Auth check
    $mysqlConnection = new mysqli('localhost','root','12344321','db');
    $result = mysqli_query($mysqlConnection, "SELECT * FROM `users` WHERE
    `login` = '{$userInfo['login']}' AND
    `password` = '{$userInfo['password']}'");
        if (mysqli_num_rows($result) !== 0) {
            $mysqlConnection -> close();
            return true;
        }
    $mysqlConnection -> close();
    return false;
}

function userReg(array $newUserInfo): bool { // New user registration
    $mysqlConnection = new mysqli('localhost','root','12344321','db');
    $result = mysqli_query($mysqlConnection, "SELECT `login`, `email` FROM `users` WHERE
    `login` = '{$newUserInfo['login']}' OR
    `email` = '{$newUserInfo['email']}'");
    if (mysqli_num_rows($result) !== 0) {
        $mysqlConnection -> close();
        return false;
    }
    $date = date('Y-m-d H:i:s');
    mysqli_query($mysqlConnection, "INSERT INTO `users` (`login`, `password`, `email`, `reg_date`)
    VALUES ('{$newUserInfo['login']}', '{$newUserInfo['password']}', '{$newUserInfo['email']}', '$date')");
    $mysqlConnection -> close();
    return true;
}

function inputDataFormat() { // Standartdizing data from post
    $userInfo = [
        "login" => htmlspecialchars(trim($_POST["login"])),
        "password" => md5(htmlspecialchars(trim($_POST["password"])) . SALT)
    ];
    if (!empty($_POST['email'])) {
        $userInfo["email"] = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    }
    return $userInfo;
}

function autoLogin() { // Cookie login check
    if (isset($_COOKIE['userKey'])) {
        $id = substr($_COOKIE['userKey'], 0, strpos($_COOKIE['userKey'], "_"));
        $mysqlConnection = new mysqli('localhost','root','12344321','db');
        $result = mysqli_query($mysqlConnection,"SELECT `id`, `login` FROM `users` WHERE `id` = '{$id}'");
        $resultArray = mysqli_fetch_assoc($result);
        if ($_COOKIE['userKey'] === $resultArray['id'] . '_' . md5($resultArray['login'] . SALT)) {
            $_SESSION["user"] = $resultArray['login'];
            $mysqlConnection -> close();
        }
    }
}
