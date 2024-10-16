<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.auth');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Rute untuk Registrasi
Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.auth');

// Rute untuk Lupa Password
Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Rute untuk pengguna biasa
Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    
    // Rute untuk melihat dan memperbarui profil pengguna
    Route::get('/user/profile/show', [UserController::class, 'showProfile'])->name('profile.show');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');

    // Rute CRUD untuk kategori
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index'); // Menampilkan semua kategori
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Menampilkan form untuk membuat kategori
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store'); // Menyimpan kategori baru
    Route::get('categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit'); // Menampilkan form untuk mengedit kategori
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Memperbarui kategori
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Menghapus kategori

    // Rute CRUD untuk postingan (posts)
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Rute CRUD untuk author
    Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('authors/store', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('authors/edit/{author}', [AuthorController::class, 'edit'])->name('authors.edit'); // Memperbaiki parameter dari {post} ke {author}
    Route::put('authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
});

// Rute untuk tamu (guest) untuk melihat kategori dan pos
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Rute fallback untuk menangani halaman yang tidak ditemukan (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
