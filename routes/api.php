<?php

use App\Http\Controllers\InvitadosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/h', function(Request $request) {
    return 'hola';
});

Route::post('invitados', [InvitadosController::class, 'store']);
Route::get('invitados/{invitado:uuid_invitado}', [InvitadosController::class, 'show']);
// Route::get('invitados/{invitado:uuid_invitado}/{dato?}', [InvitadosController::class, 'getInfoInvitado']);
Route::get('invitados/genera-token/{invitado:uuid_invitado}', [InvitadosController::class, 'generateJWT']);
