<?php
session_start();
require_once "dbconfig.php";
require "functions.php";
if (!empty($_POST)) {
    $userInfo = inputDataFormat();
    if (checkAuth($userInfo)) {
        if(isset($_POST['cookieCheckBox'])) {
            $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $result = mysqli_query($mysql,
            'SELECT `id` FROM `users` WHERE `login` = "' . $userInfo['login'] . '"');
            $resultArray = mysqli_fetch_assoc($result);
            setcookie('userKey', $resultArray['id'] . '_' . md5($userInfo['login'] . SALT), time()+3600, '/');
            $mysql -> close;
        }
        header("Location: /");
        exit;
    } 
    else {
        $_SESSION['message'] = "Wrong login or password";
        header("Location: auth.php");
        exit;
    }
}
