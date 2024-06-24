<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitadosController;

Route::get('/genera-pase/{invitado:uuid_invitado}', [PaseController::class, 'generaPase']);

// Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth');

// Panel
Route::get('/panel', [DashboardController::class, 'index'])->name('panel')->middleware('auth');
Route::prefix('invitados')->controller(InvitadosController::class)->group(function() {
    Route::post('/', 'store');
});

Route::get('/pass', function() {
    return bcrypt('admin');
});
