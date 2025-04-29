<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Routes principales
Route::get('/', [App\Http\Controllers\FrontController::class, 'index'])->name('home');

Route::get('/about', [App\Http\Controllers\FrontController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\FrontController::class, 'contact'])->name('contact');
Route::get('/apropos', [App\Http\Controllers\FrontController::class, 'apropos'])->name('apropos');
Route::get('/aproposactedenaissance', [App\Http\Controllers\FrontController::class, 'aproposactedenaissance'])->name('aproposactedenaissance');
Route::get('/aproposactedemariage', [App\Http\Controllers\FrontController::class, 'aproposactedemariage'])->name('aproposactedemariage');
Route::get('/aproposactededeces', [App\Http\Controllers\FrontController::class, 'aproposactededeces'])->name('aproposactededeces');

// Routes d'authentification
Route::get('/sign-in', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/sign-in', [App\Http\Controllers\AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/sign-up', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/sign-up', [App\Http\Controllers\AuthController::class, 'storeUser'])->name('register.store');

// Routes de réinitialisation de mot de passe
Route::get('/forgot-password', [App\Http\Controllers\AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\AuthController::class, 'updatePassword'])->name('password.update');

// Routes protégées (authentification requise)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes pour les actes d'état civil (exactement comme avant mais protégées)
    Route::get('/welcome', [App\Http\Controllers\FrontController::class, 'welcome'])->name('welcome');
    Route::get('/actedeces', [App\Http\Controllers\FrontController::class, 'actedeces'])->name('actedeces');
    Route::get('/actemariage', [App\Http\Controllers\FrontController::class, 'actemariage'])->name('actemariage');
    Route::get('/actenaissance', [App\Http\Controllers\FrontController::class, 'actenaissance'])->name('actenaissance');
    Route::get('/account', [App\Http\Controllers\FrontController::class, 'account'])->name('account');
   // Dans le groupe middleware(['auth'])
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/dashboard', [App\Http\Controllers\FrontController::class, 'dashboard'])->name('dashboard');
    Route::get('/listeactemariage', [App\Http\Controllers\FrontController::class, 'listeactemariage'])->name('listeactemariage');
    Route::get('/listeactenaissance', [App\Http\Controllers\FrontController::class, 'listeactenaissance'])->name('listeactenaissance');
    Route::get('/listeactedeces', [App\Http\Controllers\FrontController::class, 'listeactedeces'])->name('listeactedeces');
});