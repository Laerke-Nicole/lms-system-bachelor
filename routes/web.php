<?php

use App\Http\Controllers\PrivacyPolicyController;
use Illuminate\Support\Facades\Route;

Route::get('gdprs/privacy-policy', [PrivacyPolicyController::class, 'privacyPolicy'])->name('gdprs.privacy-policy');
