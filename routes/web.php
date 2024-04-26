<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::middleware('api')->group(function () {
//     // Auth
//     Route::get('/', [AuthController::class, 'index'])->name('/');
//     Route::redirect('/signout', '/');
//     Route::post('signin', [AuthController::class, ''])->name('login');
//     Route::post('signout', [AuthController::class, 'authenticate'])->name('login');
//     // End Auth
// });

Route::middleware('guest')->group(function () {
    // Auth
    Route::get('/', [AuthController::class, 'index'])->name('/');
    Route::redirect('/signout', '/');
    Route::post('/signin', [AuthController::class, 'authenticate'])->name('login');
    Route::get('/forgot-password', [ResetPasswordController::class, 'resetPassword'])->name('password.request');
    Route::post('password-email', [ResetPasswordController::class, 'sendEmailLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetView'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetProcess'])->name('password.update');
    // End Auth
});

Route::middleware('auth')->group(function () {
    // Auth
    Route::post('signout', [AuthController::class, 'signout'])->name('signout');
    // End Auth

    // API
    // User
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::post('profile', [ProfileController::class, 'upload'])->name("uploadProfile");
    Route::patch('profile/{user:user_id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    // End User
});

Route::middleware('admin')->group(function () {
    // Master
    Route::resources([
        // ===== Book =====
        'books' => BookController::class,
        // ===== End Book =====
    ]);
});
