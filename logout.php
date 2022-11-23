<?php
session_start();
session_destroy();
setcookie('userKey', '', -1, '/');
header("Location: /");
