<?php

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ParticipanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('login',[AuthController::class,'login']);

Route::apiResource('participantes',ParticipanteController::class);
Route::apiResource('eventos',EventoController::class);
Route::get('eventos-hoje', [EventoController::class, 'eventosHoje']);


Route::post('/reset-password', [PasswordResetController::class, 'sendResetLinkEmail']);

Route::post('/reset-password-token', [PasswordResetController::class, 'resetPassword']);
