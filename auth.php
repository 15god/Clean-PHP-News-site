<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <?php require "blocks/headinfo.php" ?>
        <title>1st PHP Site</title>
    </head>
    <body>
        <?php require "blocks/header.php"; ?>
        <div class="container">
            <?php require "blocks/auth_form.html" ?>
            <a class="btn btn-outline-secondary btn-lg btn-block mt-2" href="reg.php">У меня нет аккаунта</a>
            <?php flashMsg();?>
        </div>
    </body>
</html>
