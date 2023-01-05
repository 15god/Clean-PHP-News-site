<?php
session_start();
session_destroy();
setcookie('userKey', '', time()-3600, '/');
header('Location:' . $_SERVER['HTTP_REFERER']);
exit;
/*
 * $_SESSION['last_page'] = $_SERVER['PHP_SELF'];
 */
