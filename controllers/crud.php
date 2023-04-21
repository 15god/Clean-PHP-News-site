<?php
session_start();
$siteTitle = "CRUD";
isSessionActive('onlyAdmin');
$config = require "dbconfig.php";
$db = new Database($config);
$sql = "SELECT news.*, users.login, categories.category FROM news"
        . " INNER JOIN users ON author_id = users.id"
        . " INNER JOIN categories ON category_id = categories.id ";

$sort = $_GET['sort'] ?? "id";
$order = $_GET['order'] ?? 'asc';

$keywords = $_GET['keywords'] ?? "";
if ($keywords !== "") {// dodumat
    $keys = explode(",", $_GET['keywords']);
    $i = 0;
    foreach ($keys as $key) {
        $key = trim($key);
        if ($i == 0) {
            $sql .= "WHERE title LIKE '%$key%' ";
            $i++;
        } else {
            $sql .= "OR title LIKE '%$key%' ";
        }
    }
}
$date1 = $_GET['start-date'] ?? "";
$date2 = $_GET['end-date'] ?? "";
if($date1 !== "" && $date2 !== ""){
    if(str_contains($sql, 'WHERE')){
        $sql .= "AND DATE(publication_date) >= '$date1' AND DATE(publication_date) <= '$date2'";
    }
    else{
        $sql .= "WHERE DATE(publication_date) >= '$date1' AND DATE(publication_date) <= '$date2'";
    }
}

$page = $_GET['page'] ?? 0;// новостей  на странице
$count = 3;
$offset = $page * $count;
$sqlRows = substr_replace($sql, "SELECT COUNT(*)", 0, strlen("SELECT news.*, users.login, categories.category"));

$sql .= "ORDER BY $sort $order LIMIT $count OFFSET $offset";
echo $sql;
$totalRows = $db->query($sqlRows, [])->fetchColumn();
$posts = $db->query($sql, [])->fetchAll();
$categories = $db->query("SELECT category FROM categories", [])->fetchAll();
require "views/crud.view.php";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="js/crud.js"></script>
