<?php require "partials/head.php" ?>
<?php require "partials/nav.php";?>
<div class="container">
    <form action="/reg" method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" name="login" id="login" placeholder="Enter login">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <input type="hidden" name="_method" value="put">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Зарегестрироваться</button>
    </form>
    <a class="btn btn-outline-secondary btn-lg btn-block mt-2" href="/">Вернуться на главную</a>
    <?php flashMsg(); ?>
</div>
<?php require "partials/footer.php";
