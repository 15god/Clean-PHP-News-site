<?php session_start();
require "dbconfig.php";
if (!empty($_FILES['profile_pic']) && $_FILES['profile_pic']['error']=== 0) {
    $path = 'uploads/' . $_FILES['profile_pic']['name'];
    move_uploaded_file($_FILES['profile_pic']['tmp_name'] , $path);
    $imagick = new Imagick($_SERVER['DOCUMENT_ROOT'] . '/' . $path);
    if($imagick -> getImageFormat() !== 'jpg' || getImageFormat($imagick) !== 'jpeg') {
        $imagick -> setImageFormat('jpg');
        $imagick ->writeImage();
    }
    $imagick -> clear();
    /**
     * 
    $ext = pathinfo($path, PATHINFO_EXTENSION);
     * 
     */
    $newPath = 'uploads/' . 'user' . $_SESSION['userid'] . 'source.jpg';
    rename($path, $newPath);
    /**
     * хрень
     */
    if(file_exists('uploads/' . 'user' . $_SESSION['userid'] . 'big.jpg')) {
        unlink('uploads/' . 'user' . $_SESSION['userid'] . 'big.jpg');
    }
    if(file_exists('uploads/' . 'user' . $_SESSION['userid'] . 'medium.jpg')) {
        unlink('uploads/' . 'user' . $_SESSION['userid'] . 'medium.jpg');
    }
    if(file_exists('uploads/' . 'user' . $_SESSION['userid'] . 'small.jpg')) {
        unlink('uploads/' . 'user' . $_SESSION['userid'] . 'small.jpg');
    }
    unset($_FILES);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require "blocks/headinfo.php" ?>
        <title>Личный кабинет</title>
    </head>
    <body>
        <?php require "blocks/header.php"; ?>
        <div class="container">
            <?php require "blocks/profile_info.php";?>
        </div>
    </body>
</html>
