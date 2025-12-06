<?php

use App\Http\Controllers\AbInventechController;
use App\Http\Controllers\Auth\AuthSessionController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FollowUpTestController;
use App\Http\Controllers\GdprController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainingSlotController;
use Illuminate\Support\Facades\Route;

// all user roles that are authed
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('trainings', TrainingController::class);
});

// user role leader
Route::middleware(['auth', 'role:leader'])->group(function () {

});

// user role admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('companies', CompanyController::class);
    Route::resource('ab_inventech', AbInventechController::class);
    Route::resource('gdprs', GdprController::class);
    Route::resource('certificates', CertificateController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('follow_up_tests', FollowUpTestController::class);
});

Route::middleware(['auth', 'role:admin,leader'])->group(function () {
    Route::resource('sites', SiteController::class);
    Route::resource('training_slots', TrainingSlotController::class);
});
