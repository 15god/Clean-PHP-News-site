<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">PHP Site</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <?php
        if(isset($_SESSION['role_id']) && $_SESSION['role_id'] !== '1'): ?>
            <a class="p-2 text-dark" href="/crud">CRUD</a>
        <?php endif;
        if(isset($_SESSION['login'])): ?>
            <a class="p-2 text-dark" href="/profile">Добро пожаловать,  <?=$_SESSION['login']?></a>
            <img src ="<?=getImage('profile')?>" alt="profile-pic" class="mr-3 round-avatar">
        <?php endif;?>
        <a class="p-2 text-dark" href="/">Главная</a>
        <a class="p-2 text-dark" href="/album">Альбом</a>
    </nav>
    <?php if (!empty($_SESSION['login'])): ?>
        <a class="btn btn-outline-primary" href="/logout">Выйти</a>
    <?php else: ?>
        <a class="btn btn-outline-primary" href="/login">Войти</a>
    <?php endif; ?>
</div>
