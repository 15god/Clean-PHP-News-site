<?php
if (!empty($_POST) && $_POST['delete_var'] == 'deletePhoto') {
    $userAlbum = new Album();
    $userAlbum->delPhoto($_POST['filename']);
    
}

class Album {

    private $albumpath;

    public function __construct() {
        $this->albumpath = 'uploads/album' . $_SESSION['userid'];
        if (!file_exists(__DIR__ . '/' . $this->albumpath)) {
            mkdir($this->albumpath, 0777, true);
        }
    }

    public function addPhoto() {
        if (!empty($_FILES['newImg']) && $_FILES['newImg']['error'] === 0) {
            $newpath = $this->albumpath . '/' . time() . $_FILES['newImg']['name'];
            move_uploaded_file($_FILES['newImg']['tmp_name'], $newpath);
            unset($_FILES);
        } else {
            echo "err";
        }
    }

    public function delPhoto($filename) {
        unlink($filename);
    }

    public function showAlbum() {
        $files = scandir($this->albumpath);
        $links = [];
        foreach ($files as $fileName) {
            if ($fileName === '.' || $fileName === '..') {
                continue;
            }
            $links[] = $this->albumpath . '/' . $fileName;
        }
        $n = 0;
        foreach ($links as $link) {
            if ($n % 3 === 0):?>
                <div class="row">
            <?php endif; ?>
             <div class="col img-wrap">
                <a href="<?= $link ?>" data-lightbox="album" >
                    <img src="<?= $link ?>" alt="" class="img-thumbnail"/>
                </a>
                <img class="ajax" data-path="<?= $link ?>" src="lightbox_imgs/close.png" alt=""/>
            </div>
            <?php $n++;
            if ($n % 3 === 0):?>
                </div>
            <?php endif;
        }
    }
}