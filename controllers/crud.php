<?php

session_start();
$siteTitle = "CRUD";
isSessionActive('onlyAdmin');
$config = require "dbconfig.php";
$db = new Database($config);
$posts = $db->query("SELECT * FROM news")->fetchAll();
require "views/crud.view.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="js/crud.js"></script>
