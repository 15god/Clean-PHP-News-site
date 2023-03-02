<?php require "partials/head.php" ?>
<?php require "partials/nav.php"; ?>
<!-- profileImgForm -->
<div class="container">
    <div class="row">
        <div class="col">
            <form action="/profile" method="post" enctype="multipart/form-data">
                <div class="form-group" style="width:300px">
                    <img src="<?=getImage('profile','big')?>" alt="profile-pic" class="round-avatar">
                    <label for = "profile_pic">Profile picture</label>
                    <input type="file" name="profile_pic" id="profile_pic">
                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-2">Применить</button>
                </div>
            </form>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" class="form-control" name="login" id="login" value="<?= $_SESSION['login'] ?? "Login" ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Сохранить</button>
            <a href="/" class="btn btn-secondary btn-lg btn-block">Вернуться назад</a>
        </div>
    </div>
</div>
<?php require "partials/footer.php";