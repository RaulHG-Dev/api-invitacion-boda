<?php

use App\Http\Controllers\ComentariosInvitadosController;
use App\Http\Controllers\InvitadosController;
use App\Http\Middleware\JwtVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/h', function(Request $request) {
    return 'hola';
});

Route::prefix('invitados')->controller(InvitadosController::class)->group(function() {
    Route::post('/', 'store');
    Route::get('/{invitado:uuid_invitado}', 'show')->middleware(JwtVerify::class);
    // Route::get('/{token}', 'verifyToken');
    // Route::get('/genera-token/{invitado:uuid_invitado}', 'generateJWT');
    Route::post('/genera-token', 'generateJWT');
});

Route::prefix('comentarios-invitados')->controller(ComentariosInvitadosController::class)->group(function() {
    Route::post('/', 'store')->middleware(JwtVerify::class);
});


// Route::get('invitados/{invitado:uuid_invitado}/{dato?}', [InvitadosController::class, 'getInfoInvitado']);
