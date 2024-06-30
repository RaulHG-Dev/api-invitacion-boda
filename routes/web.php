<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitadosController;
use App\Http\Controllers\ComentariosInvitadosController;

Route::get('/genera-pase/{invitado:uuid_invitado}', [PaseController::class, 'generaPase']);

// Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Panel
Route::get('/panel', [DashboardController::class, 'index'])->name('panel')->middleware('auth');
Route::prefix('invitados')->controller(InvitadosController::class)->group(function() {
    Route::post('/', 'store');
    Route::get('/{invitado:uuid_invitado}', 'show');
    Route::delete('/{invitado:uuid_invitado}', 'delete');
    Route::post('/actualizar', 'update');
    Route::get('generar-qr/{invitado:uuid_invitado}', 'generateQR')->name('generateQr');
})->middleware('auth');

Route::get('/deseos', [ComentariosInvitadosController::class, 'index'])->name('deseos')->middleware('auth');
