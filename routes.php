<?php

$this->get('/auth', AuthController::class, 'create')->only('guest');
$this->post('/auth', AuthController::class, 'store')->only('guest');
$this->get('/logout', AuthController::class, 'destroy')->only('auth');//change to delete

$this->get('/reg', RegistrationController::class, 'create')->only('guest');
$this->put('/reg', RegistrationController::class, 'store')->only('guest');

$this->get('/profile', ProfileController::class, 'show')->only('auth');
$this->patch('/profile', ProfileController::class, 'update')->only('auth');

$this->get('/album', AlbumController::class, 'show')->only('auth');
$this->put('/album', AlbumController::class, 'store')->only('auth');
$this->delete('/album', AlbumController::class, 'destroy')->only('auth');

$this->get('/crud', 'crud.php')->only('admin'); // extract crud logic to a different file from newscontroller

$this->get('/', NewsController::class, 'list');
$this->get('/news', NewsController::class, 'show');

$this->delete('/crud', NewsController::class, 'destroy')->only('admin');
$this->put('/crud', NewsController::class, 'store')->only('admin');
$this->patch('/crud', NewsController::class, 'edit')->only('admin');

$this->get('/redact-wyswig', 'redact.php')->only('admin');

