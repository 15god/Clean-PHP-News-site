<?php

use Models\Album;

class AlbumController {

//    private $albumpath;
//
//    public function __construct() {
//
//        $this->albumpath = 'uploads/album' . $_SESSION['user_id'];
//        if (!file_exists($this->albumpath)) {
//            mkdir($this->albumpath, 0777, true);
//        }
//    }

    public function show() {

        $photoLinks = Album::getAlbum();

        view("album.view.php", [
            "siteTitle" => "Альбом",
            "photoLinks" => $photoLinks
        ]);
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="js/albumDeletion.js"></script>
        <script src="js/lightbox-plus-jquery.js"></script>
        <?php

    }

    public function store() {

        Album::uploadPhoto();
        header("Location: /album");
        exit();
    }

    public function destroy() {

        Album::deletePhoto($_POST['filename']);
    }

}
