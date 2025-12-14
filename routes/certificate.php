<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;

Route::middleware(['auth', 'role:user,leader'])->controller(CertificateController::class)->group(function () {
    Route::get('/certificates/{trainingUser}/preview', 'preview')->name('certificates.certificate-preview');
    Route::get('/certificates/{training_id}/confirmation', 'certificateConfirmation')->name('certificates.certificate-confirmation');
    Route::get('/certificates/{training_id}', 'certificatePdf')->name('certificates.certificatePdf');
});
