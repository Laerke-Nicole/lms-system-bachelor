<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignatureController;

Route::middleware(['auth', 'role:user,leader'])->group(function () {
    Route::get('/signatures/{trainingUser}/choose', [SignatureController::class, 'choose'])->name('signatures.choose');

//    user signs digitally
    Route::get('/signatures/{trainingUser}/digital', [SignatureController::class, 'digitalForm'])->name('signatures.digital');
    Route::post('/signatures/{trainingUser}/digital', [SignatureController::class, 'digitalSubmit'])->name('signatures.digital-submit');

//    user signs by printing
    Route::get('/signatures/{trainingUser}/printed', [SignatureController::class, 'printedForm'])->name('signatures.printed');
    Route::post('/signatures/{trainingUser}/printed', [SignatureController::class, 'printedSubmit'])->name('signatures.printed-submit');
});
