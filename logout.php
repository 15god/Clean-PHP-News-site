<?php
session_start();
session_destroy();
setcookie('userKey', '', time()-3600, '/');
header("Location: /");
