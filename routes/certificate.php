<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;

Route::middleware(['auth', 'role:user,leader'])->group(function () {
    Route::get('/certificates/{trainingUser}/unsigned', [CertificateController::class, 'unsigned'])->name('certificates.unsigned');
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{training_id}/view', [CertificateController::class, 'viewCertificate'])->name('certificates.viewCertificate');
    Route::get('/certificates/{training_id}', [CertificateController::class, 'certificatePdf'])->name('certificates.certificatePdf');
});
