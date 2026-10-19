<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEBSITE PUBLIK
|--------------------------------------------------------------------------
*/

Route::middleware('maintenance')->group(function () {
    Route::get('/', [SiteController::class, 'home'])->name('home');
    Route::get('/informasi', [SiteController::class, 'posts'])->name('posts.index');
    Route::get('/informasi/{post:slug}', [SiteController::class, 'post'])->name('posts.show');
    Route::get('/kategori/{category:slug}', [SiteController::class, 'category'])->name('posts.category');
    Route::get('/halaman/{page:slug}', [SiteController::class, 'page'])->name('pages.show');
    Route::get('/kontak', [SiteController::class, 'contact'])->name('contact');
});

/*
|--------------------------------------------------------------------------
| AUTENTIKASI
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1')->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| DASBOR (admin & operator)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,operator'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('posts', Admin\PostController::class)->except('show');
    Route::post('editor/upload', [Admin\EditorUploadController::class, 'store'])->name('editor.upload');

    Route::get('profil', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profil', [Admin\ProfileController::class, 'update'])->name('profile.update');

    // Khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', Admin\CategoryController::class)->except('show');
        Route::resource('pages', Admin\PageController::class)->except('show');
        Route::resource('users', Admin\UserController::class)->except('show');

        Route::get('pengaturan', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('pengaturan', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
