<?php
session_start();
$siteTitle = "Профиль";
require "isSessionActive.php";
if (!empty($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $path = 'uploads/' . $_FILES['profile_pic']['name'];
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $path);
    $imagick = new Imagick($_SERVER['DOCUMENT_ROOT'] . '/' . $path);
    if ($imagick->getImageFormat() !== 'jpg' || $imagick->getImageFormat() !== 'jpeg') {
        $imagick->setImageFormat('jpg');
        $imagick->writeImage();
    }
    $imagick->clear();
    $newPath = 'uploads/' . 'user' . $_SESSION['userid'] . 'source.jpg';
    rename($path, $newPath);
    $sizes = array('big', 'medium', 'small');
    foreach ($sizes as $size) {
        if (file_exists('uploads/' . 'user' . $_SESSION['userid'] . $size . '.jpg')) {
            unlink('uploads/' . 'user' . $_SESSION['userid'] . $size . '.jpg');
        }
    }
    unset($_FILES);
}
require "views/profile.view.php";
