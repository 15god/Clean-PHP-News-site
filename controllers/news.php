<?php

session_start();
$siteTitle = "Home";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$query = "SELECT * FROM news WHERE id =?";
$stmt = mysqli_stmt_init($mysqli);
mysqli_stmt_prepare($stmt, $query);
mysqli_stmt_bind_param($stmt, "i",$_GET['id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$resultArray = mysqli_fetch_assoc($result);
$mysqli->close();
disposeData($resultArray);
require "views/news.view.php";
