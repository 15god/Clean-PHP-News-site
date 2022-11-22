<?php

session_start();
if (!empty($_POST)) {
    require "functions.php";
    $userInfo = inputDataFormat();
    if (checkAuth($userInfo)) {
        $_SESSION["id"] = session_id();
        header("Location: /");
    } else {
        $_SESSION['message'] = "Wrong login or password";
        header("Location: auth.php");
    }
}
