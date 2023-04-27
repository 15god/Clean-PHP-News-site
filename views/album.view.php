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
<?php require "partials/footer.php";