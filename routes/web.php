<?php

use App\Http\Controllers\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('gdprs/privacy-policy', [PrivacyPolicyController::class, 'privacyPolicy'])->name('gdprs.privacy-policy');
