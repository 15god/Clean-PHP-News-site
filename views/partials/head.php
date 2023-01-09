<?php
function autoLogin() { // Cookie login check
    if (isset($_COOKIE['userKey'])) {
        $id = explode("_", $_COOKIE['userKey']);
        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = mysqli_query($mysql, 'SELECT `id`, `login` FROM `users` WHERE `id` = "' . $id[0] . '"');
        $resultArray = mysqli_fetch_assoc($result);
        if ($_COOKIE['userKey'] === $resultArray['id'] . '_' . md5($resultArray['login'] . SALT)) {
            $_SESSION['user'] = $resultArray['login'];
            $mysql->close();
        }
    }
}
autoLogin();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" lang="ru">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA=Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/lightbox.css" type="text/css">
        <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
        <title><?= $siteTitle?></title>
    </head>
    <body>