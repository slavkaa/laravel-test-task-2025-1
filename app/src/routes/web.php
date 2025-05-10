<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RegistrationController;
use \App\Http\Controllers\GameController;

Route::get('/', [RegistrationController::class, 'show'])
    ->name('registration.show');

Route::post('/registration/create-hash', [RegistrationController::class, 'createHash'])
    ->name('registration.create_hash');

Route::post('/registration/deactivate-hash', [RegistrationController::class, 'deactivateHash'])
    ->name('registration.deactivate_hash');

Route::get('/page-a/{hash}', [RegistrationController::class, 'pageA'])
    ->name('registration.page_a.show');

Route::post('/game/i-am-feeling-lucky', [GameController::class, 'iAmFeelingLucky'])
    ->name('game.i_am_feeling_lucky');

Route::post('/game/get-history', [GameController::class, 'getHistory'])
    ->name('game.get_history');
