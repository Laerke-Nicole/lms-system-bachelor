<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AbInventechController;
use App\Http\Controllers\GdprController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FollowUpTestController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\FollowUpMaterialController;
use App\Http\Controllers\PreparationController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\AuthController;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomeController::class, 'index'])->name('home');

//layout
//auth
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['guest'])->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});



//app
Route::middleware(['auth'])->group(function () {
    Route::resource('postal_codes', PostalCodeController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('ab_inventech', AbInventechController::class);
    Route::resource('gdprs', GdprController::class);
    Route::resource('certificates', CertificateController::class);
//Route::resource('emails', EmailController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('follow_up_tests', FollowUpTestController::class);
    Route::resource('trainings', TrainingController::class);
    Route::resource('follow_up_materials', FollowUpMaterialController::class);
    Route::resource('preparations', PreparationController::class);
    Route::resource('requirements', RequirementController::class);
});
