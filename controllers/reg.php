<?php
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