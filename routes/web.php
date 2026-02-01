<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Security Question Recovery
Route::post('/password/security/question', [App\Http\Controllers\Auth\SecurityRecoveryController::class, 'getQuestion'])->name('password.security.question');
Route::post('/password/security/verify', [App\Http\Controllers\Auth\SecurityRecoveryController::class, 'verify'])->name('password.security.verify');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'index'])->name('admin.ajustes');
Route::put('/admin/ajustes', [App\Http\Controllers\AjusteController::class, 'update'])->name('admin.ajustes.update');

// User Management Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::post('users/{user}/toggle-status', [App\Http\Controllers\UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');

    // Community Structure Routes (Manzanas)
    Route::resource('manzanas', App\Http\Controllers\ManzanaController::class)->only(['index', 'store', 'update', 'destroy']);

    // Family Module Routes
    Route::resource('familias', App\Http\Controllers\FamiliaController::class);
    
    // Ficha Familiar Routes (nested under familias)
    Route::resource('familias.fichas', App\Http\Controllers\FichaFamiliarController::class);

    // Profile Routes
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('profile/theme', [App\Http\Controllers\ProfileController::class, 'updateTheme'])->name('profile.theme');
    Route::post('profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('profile/security', [App\Http\Controllers\ProfileController::class, 'updateSecurity'])->name('profile.security');
});