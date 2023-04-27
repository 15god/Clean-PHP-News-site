<?php

namespace Models;

use Imagick;

class Profile {

    public static function changeProfilePic() {
//file upload errors
        $path = base_path('public/uploads/' . $_FILES['profile_pic']['name']);
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $path);
        $imagick = new Imagick($path);
        if ($imagick->getImageFormat() !== 'jpg' || $imagick->getImageFormat() !== 'jpeg') {
            $imagick->setImageFormat('jpg');
            $imagick->writeImage();
        }
        $imagick->clear();
        $newPath = base_path('public/uploads/' . 'user' . $_SESSION['user_id'] . 'source.jpg');
        rename($path, $newPath);
        $sizes = array('big', 'medium', 'small');
        foreach ($sizes as $size) {
            if (file_exists(base_path('public/uploads/' . 'user' . $_SESSION['user_id'] . $size . '.jpg'))) {
                unlink(base_path('public/uploads/' . 'user' . $_SESSION['user_id'] . $size . '.jpg'));
            }
        }
        unset($_FILES);
    }

}
