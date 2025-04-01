<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// ✅ Main Feed Page (Accessible by Everyone)
Route::get('/app', [PostController::class, 'index'])->name('app');

// ✅ Protected User Creation Route
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['edit', 'update', 'destroy']);
    Route::patch('posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
    Route::patch('posts/{id}/reject', [PostController::class, 'reject'])->name('posts.reject');
});

// ✅ Authentication Routes
Route::resource('auth', AuthController::class)->only(['create', 'store', 'index', 'destroy'])
    ->names([
        'index' => 'login',
    ]);
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'create'])->name('register');

// ✅ Protected Dashboard
Route::middleware('auth')->get('/dashboard', function () {
    $posts = \App\Models\Post::where('status', 'approved')->latest()->get();
    return view('dashboard', compact('posts'));
})->name('dashboard');


// ✅ Other Routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/AdminLogin', function () {
    return view('AdminLogin');
});
Route::resource('admin', AdminController::class);
Route::resource('main', MainController::class);
