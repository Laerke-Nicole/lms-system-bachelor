<?php

use App\Http\Controllers\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\CertificateController;

Route::get('/', function () {
    return view('home');
});

Route::get('gdprs/privacy-policy', [PrivacyPolicyController::class, 'privacyPolicy'])->name('gdprs.privacy-policy');

// user role user and leader
Route::middleware(['auth', 'role:user,leader'])->group(function () {
    Route::get('/signatures', [SignatureController::class, 'index'])->name('signatures.index');
    Route::post('/signatures/{trainingUserId}', [SignatureController::class, 'sign'])->name('signatures.sign');
    Route::get('/certificates/{training_id}', [CertificateController::class, 'certificate'])->name('certificates.certificate');
    Route::resource('certificates', CertificateController::class);
});
