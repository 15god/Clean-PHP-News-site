<?php

isSessionActive("onlyAdmin");
require "views/redact.view.php";
view("redact.view.php", [
    "siteTitle" => "Редактирование новости",
]);