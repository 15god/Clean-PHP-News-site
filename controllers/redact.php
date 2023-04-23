<?php 

session_start();
$siteTitle = "Редактирование новости";
isSessionActive("onlyAdmin");
require "views/redact.view.php";


?>