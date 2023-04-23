<?php

$this->get('/auth', 'auth.php');
$this->post('/auth', 'auth.php');

$this->get('/logout', 'logout.php');

$this->get('/reg', 'reg.php');
$this->post('/reg', 'reg.php');

$this->get('/profile', 'profile.php');
$this->post('/profile', 'profile.php');

$this->get('/album', 'album.php');
$this->post('/album', 'album.php');

$this->get('/crud', 'crud.php');

$this->get('/', NewsController::class, 'list');
$this->get('/news', NewsController::class, 'show');
$this->post('/crud-delete', NewsController::class, 'delete');
$this->post('/crud-create', NewsController::class, 'create');
$this->post('/crud-update', NewsController::class, 'update');

$this->get('/redact-wyswig', 'redact.php');

