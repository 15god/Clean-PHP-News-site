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
            <?php
            if (!empty($_SESSION['message'])) {
                if ($_SESSION['message'] == "User registered"):
                    ?>
                    <div class="alert alert-success mt-2" role="alert">
                        <?php
                        echo $msg = $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </div>
                <?php elseif ($_SESSION['message'] == "Wrong login or password"): ?>
                    <div class="alert alert-danger mt-2" role="alert">
                        <?php
                        echo $msg = $_SESSION['message'];
                        unset($_SESSION['message']);
                        ?>
                    </div>
                <?php endif;
            }
            ?>
        </div>
    </body>
</html>
