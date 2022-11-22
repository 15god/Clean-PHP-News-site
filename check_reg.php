<?php
session_start();
if (!empty($_POST)) {
    require "functions.php";
    $newUserInfo = inputDataFormat();
    userReg($newUserInfo);
    $_SESSION['message'] = "User registered";
    header("Location: auth.php");
}
else {
    $_SESSION['message'] = "Registration failed";
    header("Location: reg.php");
}