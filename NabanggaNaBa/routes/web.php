<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;

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