<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Admin Dashboard route
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', [
            'pendingVehicles' => \App\Models\Post::where('status', 'pending')->get()
        ]);
    })->name('admin.dashboard');

    // Route for approving a vehicle post
    Route::post('/admin/approve/{id}', function ($id) {
        $vehicle = \App\Models\Post::findOrFail($id);
        $vehicle->status = 'approved';
        $vehicle->save();

        return redirect()->route('admin.dashboard')->with('success', 'Vehicle post approved!');
    })->name('admin.approve');

    // Route for rejecting a vehicle post
    Route::post('/admin/reject/{id}', function ($id) {
        $vehicle = \App\Models\Post::findOrFail($id);
        $vehicle->status = 'rejected';
        $vehicle->save();

        return redirect()->route('admin.dashboard')->with('error', 'Vehicle post rejected!');
    })->name('admin.reject');
});

// Main Feed Page (Accessible by Everyone)
Route::get('/app', [PostController::class, 'index'])->name('app');

// Protected User Creation Route
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['edit', 'update', 'destroy']);
    Route::patch('posts/{id}/approve', [PostController::class, 'approve'])->name('posts.approve');
    Route::patch('posts/{id}/reject', [PostController::class, 'reject'])->name('posts.reject');
});

// Authentication Routes
Route::resource('auth', AuthController::class)->only(['create', 'store', 'index', 'destroy'])
    ->names([
        'index' => 'login',
    ]);
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/register', [AuthController::class, 'create'])->name('register');

// Protected Dashboard
Route::middleware('auth')->get('/dashboard', function () {
    $posts = \App\Models\Post::where('status', 'approved')->latest()->get();
    return view('dashboard', compact('posts'));
})->name('dashboard');


// Other Routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/AdminLogin', function () {
    return view('AdminLogin');
});

Route::resource('main', MainController::class);
