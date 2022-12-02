<?php
session_start();
if (!empty($_POST)) {
    require "functions.php";
    validateData();
    $newUserInfo = inputDataFormat();
    if (userReg($newUserInfo)) {
        $_SESSION['message'] = "User registered";
        header("Location: auth.php");
    }
    else {
        $_SESSION['message'] = "Username or email is already in use";
        header("Location: reg.php");
    }
}