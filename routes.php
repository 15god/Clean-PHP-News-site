<?php

$this->get('/auth', 'controllers/auth.php');
$this->post('/auth', 'controllers/auth.php');

$this->get('/reg', 'controllers/reg.php');
$this->post('/reg', 'controllers/reg.php');

$this->get('/profile', 'controllers/profile.php');
$this->post('/profile', 'controllers/profile.php');

$this->get('/album', 'controllers/album.php');
$this->post('/album', 'controllers/album.php');

$this->get('/crud', 'controllers/crud.php');

$this->get('/', NewsController::class, 'list');
$this->get('/news', NewsController::class, 'show');
$this->post('/crud-delete', NewsController::class, 'delete');
$this->post('/crud-create', NewsController::class, 'create');
$this->post('/crud-update', NewsController::class, 'update');

$this->get('/redact-wyswig', 'controllers/redact.php');

