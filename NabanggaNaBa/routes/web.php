<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


// Using resource for Auth
Route::resource('auth', AuthController::class)->only(['create', 'store', 'index', 'destroy'])   
    ->names([
        'index' => 'login',
    ]);

// Additional route for login
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register', [AuthController::class, 'create'])->name('register');

// Protected Dashboard Route
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


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