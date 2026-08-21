<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\WorkController as AdminWorkController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/works', [WorkController::class, 'index'])->name('works.index');
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/{slug}', [AlbumController::class, 'show'])->name('albums.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/orders/{orderNumber}/success', [OrderController::class, 'success'])->name('orders.success');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/secret', [AuthController::class, 'loginWithSecret']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Portal
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/albums/generate-description', [AdminAlbumController::class, 'generateDescription'])->name('albums.generate-description');
    Route::resource('albums', AdminAlbumController::class)->except(['show']);
    Route::resource('works', AdminWorkController::class)->except(['show']);
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'edit']);
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/password', [\App\Http\Controllers\Admin\PasswordController::class, 'edit'])->name('password.edit');
    Route::put('/password', [\App\Http\Controllers\Admin\PasswordController::class, 'update'])->name('password.update');
});

