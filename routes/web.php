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

    // Pathology Management Routes
    // Gestión de Tipos de Patologías (Admin)
    Route::resource('patologias/tipos', App\Http\Controllers\TipoPatologiaController::class)->names('patologias.tipos');
    
    // Field Management for Pathology Types
    Route::post('patologias/tipos/{tipo}/campos', [App\Http\Controllers\PatologiaCampoController::class, 'store'])->name('patologias.campos.store');
    Route::put('patologias/campos/{campo}', [App\Http\Controllers\PatologiaCampoController::class, 'update'])->name('patologias.campos.update');
    Route::delete('patologias/campos/{campo}', [App\Http\Controllers\PatologiaCampoController::class, 'destroy'])->name('patologias.campos.destroy');
    
    // CRUD de Registros de Patologías (Genérico para cualquier tipo)
    Route::get('patologias/{tipo}', [App\Http\Controllers\PatologiaRegistroController::class, 'index'])->name('patologias.index');
    Route::get('patologias/{tipo}/create', [App\Http\Controllers\PatologiaRegistroController::class, 'create'])->name('patologias.create');
    Route::post('patologias/{tipo}', [App\Http\Controllers\PatologiaRegistroController::class, 'store'])->name('patologias.store');
    Route::get('patologias/{tipo}/{id}', [App\Http\Controllers\PatologiaRegistroController::class, 'show'])->name('patologias.show');
    Route::get('patologias/{tipo}/{id}/edit', [App\Http\Controllers\PatologiaRegistroController::class, 'edit'])->name('patologias.edit');
    Route::put('patologias/{tipo}/{id}', [App\Http\Controllers\PatologiaRegistroController::class, 'update'])->name('patologias.update');
    Route::delete('patologias/{tipo}/{id}', [App\Http\Controllers\PatologiaRegistroController::class, 'destroy'])->name('patologias.destroy');
    Route::get('patologias/{tipo}/{id}/pdf', [App\Http\Controllers\PatologiaRegistroController::class, 'exportPdf'])->name('patologias.pdf');
    Route::get('patologias/{tipo}/export/excel', [App\Http\Controllers\PatologiaRegistroController::class, 'exportExcel'])->name('patologias.export.excel');
});