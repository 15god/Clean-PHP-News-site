<?php

namespace Models;

class Album {
    
    public static function getAlbum() {
        
        $albumpath = 'uploads/album' . $_SESSION['user_id'];
        if (!file_exists($albumpath)) {
            mkdir($albumpath, 0777, true);
        }
        $files = scandir($albumpath);
        $photoLinks = [];
        foreach ($files as $fileName) {
            if ($fileName === '.' || $fileName === '..') {
                continue;
            }
            $photoLinks[] = $albumpath . '/' . $fileName;
        }
        return $photoLinks;
    }

    public static function uploadPhoto() {//file upload errors
        
        $albumpath = 'uploads/album' . $_SESSION['user_id'];
        $newpath = $albumpath . '/' . time() . $_FILES['newImg']['name'];
        move_uploaded_file($_FILES['newImg']['tmp_name'], $newpath);
        unset($_FILES);

    }

    public static function deletePhoto($filename) {
        
        unlink($filename);
    }

}
