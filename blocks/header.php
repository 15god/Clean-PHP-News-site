<?php
?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">PHP Site</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <?php
        if(isset($_SESSION['user'])): ?>
            <span> Добро пожаловать,  <?= $_SESSION['user']?> </span>
        <?php endif;?>
        <a class="p-2 text-dark" href="/">Главная</a>
        <a class="p-2 text-dark" href="#">Контакты</a>
    </nav>
    <?php if (!empty($_SESSION)): ?>
        <a class="btn btn-outline-primary" href="logout.php">Выйти</a>
    <?php else: ?>
        <a class="btn btn-outline-primary" href="auth.php">Войти</a>
    <?php endif; ?>
</div>
