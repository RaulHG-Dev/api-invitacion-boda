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

Route::post('/invitado', [InvitadosController::class, 'store']);
