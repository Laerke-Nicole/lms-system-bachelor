<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin,leader'])->controller(RegisteredUserController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::post('/register', 'register')->name('register');
});
