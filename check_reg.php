<?php
session_start();
if (!empty($_POST)) {
    require "functions.php";
    validateData();
    $newUserInfo = inputDataFormat();
    if (userReg($newUserInfo)) {
        $_SESSION['message'] = "User registered";
        header("Location: auth.php");
        exit;
    }
    else {
        $_SESSION['message'] = "Username or email is already in use";
        header("Location: reg.php");
        exit;
    }
}