<?php

use App\Http\Controllers\PaseController;
use Illuminate\Support\Facades\Route;

Route::get('/genera', [PaseController::class, 'generaPase']);
Route::get('/genera-pase/{invitado:uuid_invitado}', [PaseController::class, 'generaPase']);
