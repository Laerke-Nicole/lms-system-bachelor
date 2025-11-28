<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ContactController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles', [ProfileController::class, 'update'])->name('profiles.update');
    Route::get('/profiles/certificates', [ProfileController::class, 'certificates'])->name('profiles.certificates');
    Route::get('/profiles/contacts', [ContactController::class, 'show'])->name('profiles.contacts');
});
