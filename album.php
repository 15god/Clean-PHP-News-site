<?php session_start();
require_once 'albumController.php';
if(!isset($_SESSION['userid'])) {
    header("Location: /");
    exit;
}
$userAlbum = new Album();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userAlbum->addPhoto();
    header("Location: album.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require "blocks/headinfo.php" ?>
        <title>Your Album</title>
    </head>
    <body>
        <?php require "blocks/header.php"; ?>
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group" style="width:300px">
                <label for = "newImg">Загрузить фото в альбом</label>
                <input type="file" name="newImg" id="newImg">
                <button type="submit" class="btn btn-primary btn-lg btn-block mt-2">Применить</button>
            </div>
        </form>
        <?php $userAlbum->showAlbum();?>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="js/albumDeletion.js"></script>
        <script src="js/lightbox-plus-jquery.js"></script>
    </body>
</html>
