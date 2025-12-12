<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;

Route::middleware(['auth', 'role:user,leader'])->group(function () {
    Route::get('/certificates/{trainingUser}/preview', [CertificateController::class, 'preview'])->name('certificates.certificate-preview');
    Route::get('/certificates/{training_id}/confirmation', [CertificateController::class, 'certificateConfirmation'])->name('certificates.certificate-confirmation');
    Route::get('/certificates/{training_id}', [CertificateController::class, 'certificatePdf'])->name('certificates.certificatePdf');
});
