<?php require "partials/head.php" ?>
<?php require "partials/nav.php"; ?>
<div class="container">
    <form action="/album" method="post" enctype="multipart/form-data">
        <div class="form-group" style="width:300px">
            <label for = "newImg">Загрузить фото в альбом</label>
            <input type="file" name="newImg" id="newImg">
            <input type="hidden" name="_method" value="put">
            <button type="submit" class="btn btn-primary btn-lg btn-block mt-2">Применить</button>
        </div>
    </form>
    <?php require "partials/album.php"?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="js/albumDeletion.js"></script>
<script src="js/lightbox-plus-jquery.js"></script>
<?php require "partials/footer.php";