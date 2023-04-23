<?php

session_start();
session_destroy();
$_SESSION = [];
setcookie('userKey', '', time() - 3600, '/');
setcookie('PHPSESSID', '', time() - 3600, '/');
header('Location:' . $_SERVER['HTTP_REFERER']);
exit();