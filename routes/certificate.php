<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\CertificateController;

Route::middleware(['auth', 'role:user,leader'])->group(function () {
    Route::get('/signatures', [SignatureController::class, 'index'])->name('signatures.index');
    Route::post('/signatures/{trainingUserId}', [SignatureController::class, 'sign'])->name('signatures.sign');
    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/{training_id}/view', [CertificateController::class, 'viewCertificate'])->name('certificates.viewCertificate');
    Route::get('/certificates/{training_id}', [CertificateController::class, 'certificatePdf'])->name('certificates.certificatePdf');
});
