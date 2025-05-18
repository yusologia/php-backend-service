<?php

use Core\Route;
use App\Controller\Controller;

Route::get('/', function () {
    return 'Hello World!';
});

Route::get('/contact', [Controller::class, 'contact']);
