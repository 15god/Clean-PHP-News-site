<?php

isSessionActive();
if (!empty($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $path = base_path('uploads/' . $_FILES['profile_pic']['name']);
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $path);
    $imagick = new Imagick($path);
    if ($imagick->getImageFormat() !== 'jpg' || $imagick->getImageFormat() !== 'jpeg') {
        $imagick->setImageFormat('jpg');
        $imagick->writeImage();
    }
    $imagick->clear();
    $newPath = base_path('uploads/' . 'user' . $_SESSION['userid'] . 'source.jpg');
    rename($path, $newPath);
    $sizes = array('big', 'medium', 'small');
    foreach ($sizes as $size) {
        if (file_exists(base_path('uploads/' . 'user' . $_SESSION['userid'] . $size . '.jpg'))) {
            unlink(base_path('uploads/' . 'user' . $_SESSION['userid'] . $size . '.jpg'));
        }
    }
    unset($_FILES);
}
view("profile.view.php", [
    "siteTitle" => "Профиль",
]);
