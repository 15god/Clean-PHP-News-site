<?php

session_start();
$siteTitle = "CRUD";
isSessionActive('onlyAdmin');
$config = require "dbconfig.php";
$db = new Database($config);
$sort = $GET['sort'] ?? 'id';
$order = $GET['order'] ?? 'ASC';
$sql = "SELECT news.*, users.login, categories.category FROM news"
. " INNER JOIN users ON author_id = users.id"
. " INNER JOIN categories ON category_id = categories.id ORDER BY $sort $order";
$posts = $db->query($sql, [])->fetchAll();
disposeData($posts);
require "views/crud.view.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="js/crud.js"></script>
