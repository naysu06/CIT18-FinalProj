<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/app', function () {
    return view('app');
});

Route::get('/AdminLogin', function () {
    return view('AdminLogin');
});

Route::resource('admin', [AdminController::class, 'Admin']);

Route::resource('main', [MainController::class, 'Main']);