<?php
session_start();
$siteTitle = "Home";
$db = new Database($config);
$posts = $db->query("SELECT * FROM news")->fetchAll();
require "views/index.view.php";