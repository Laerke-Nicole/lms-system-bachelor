<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ContactController;

Route::middleware(['auth'])->controller(ProfileController::class)->group(function () {
    Route::get('/profiles', 'edit')->name('profiles.edit');
    Route::put('/profiles', 'update')->name('profiles.update');
    Route::get('/profiles/certificates', 'certificates')->name('profiles.certificates');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profiles/contacts', [ContactController::class, 'show'])->name('profiles.contacts');
});
