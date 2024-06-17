<?php

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
    Route::post('/genera-token', 'generateJWT');
});


// Route::get('invitados/{invitado:uuid_invitado}/{dato?}', [InvitadosController::class, 'getInfoInvitado']);
