<?php
require "partials/head.php";
require "partials/nav.php"; ?>
<div class="container">
    <form action="/auth" method="post">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" name="login" id="login" placeholder="Enter login">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="cookieCheckBox" id="cookieCheckBox">
            <label class="form-check-label" for="cookieCheckBox">Запомнить меня</label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Войти</button>
    </form>
    <a class="btn btn-outline-secondary btn-lg btn-block mt-2" href="/reg">У меня нет аккаунта</a>
    <?php flashMsg(); ?>
</div>
<?php require "partials/footer.php";