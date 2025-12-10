<?php

use App\Http\Controllers\Auth\AuthSessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->controller(AuthSessionController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/login', 'login')->name('login');
});
