<?php
session_start();
require "functions.php";
if (!empty($_POST)) {
    $userInfo = inputDataFormat();
    if (checkAuth($userInfo)) {
        if(isset($_POST['cookieCheckBox'])) {
            $mysqlConnection = new mysqli('localhost','root','12344321', 'db');
            $result = mysqli_query($mysqlConnection, "SELECT `id` FROM `users` WHERE `login` = {$userInfo['login']}");
            $resultArray = mysqli_fetch_assoc($result);
            setcookie('userKey', $resultArray['id'] . '_' . md5($userInfo['login'] . SALT), 0, '/');
            $mysqlConnection -> close;
        }
        $_SESSION["user"] = $userInfo["login"];
        header("Location: /");
    } else {
        $_SESSION['message'] = "Wrong login or password";
        header("Location: auth.php");
    }
}
