<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignatureController;

Route::middleware(['auth', 'role:user,leader'])->controller(SignatureController::class)->group(function () {
    Route::get('/signatures/{trainingUser}/choose', 'choose')->name('signatures.choose');

//    user signs digitally
    Route::get('/signatures/{trainingUser}/digital', 'digitalForm')->name('signatures.digital.digital');
    Route::post('/signatures/{trainingUser}/digital', 'digitalImage')->name('signatures.digital.digital-image');
    Route::get('/signatures/{trainingUser}/digital/confirm', 'digitalConfirm')->name('signatures.digital.digital-confirm');
    Route::post('/signatures/{trainingUser}/digital/confirm', 'digitalSubmit')->name('signatures.digital.digital-submit');

//    user signs by printing
    Route::get('/signatures/{trainingUser}/printed', 'printedForm')->name('signatures.printed.printed');
    Route::post('/signatures/{trainingUser}/printed', 'printedSubmit')->name('signatures.printed.printed-submit');
});
