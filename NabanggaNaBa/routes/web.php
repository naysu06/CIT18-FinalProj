<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/app', function () {
    return view('app');
});

Route::get('/AdminLogin', function () {
    return view('AdminLogin');
});

Route::resource('admin', AdminController::class);

Route::resource('main', MainController::class);