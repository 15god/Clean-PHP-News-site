<?php

$this->get('/login', LoginController::class, 'create')->only('guest');
$this->post('/login', LoginController::class, 'store')->only('guest');
$this->get('/logout', LoginController::class, 'destroy')->only('auth');//change to delete

$this->get('/reg', RegistrationController::class, 'create')->only('guest');
$this->put('/reg', RegistrationController::class, 'store')->only('guest');

$this->get('/profile', ProfileController::class, 'show')->only('auth');
$this->patch('/profile', ProfileController::class, 'update')->only('auth');

$this->get('/album', AlbumController::class, 'show')->only('auth');
$this->put('/album', AlbumController::class, 'store')->only('auth');
$this->delete('/album', AlbumController::class, 'destroy')->only('auth');

$this->get('/', NewsController::class, 'list');
$this->get('/news', NewsController::class, 'show');

$this->get('/crud', CRUDController::class, 'list')->only('admin');
$this->delete('/crud', CRUDController::class, 'destroy')->only('admin');
$this->put('/crud', CRUDController::class, 'store')->only('admin');
$this->patch('/crud', CRUDController::class, 'edit')->only('admin');

$this->get('/crudEdit', CRUDController::class, 'show')->only('admin');
$this->patch('/crudEdit', CRUDController::class, 'editContent')->only('admin');//ajax nado

