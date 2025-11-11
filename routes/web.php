<?php

use App\Http\Controllers\AbInventechController;
use App\Http\Controllers\Auth\AuthSessionController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\FollowUpMaterialController;
use App\Http\Controllers\FollowUpTestController;
use App\Http\Controllers\GdprController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PreparationController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//layout
//auth
Route::middleware(['guest'])->controller(RegisteredUserController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::post('/register', 'register')->name('register');
});

Route::middleware(['guest'])->controller(AuthSessionController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/login', 'login')->name('login');
});



//app
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthSessionController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('home');
//    Route::resource('postal_codes', PostalCodeController::class);
//    Route::resource('addresses', AddressController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('sites', SiteController::class);
    Route::resource('ab_inventech', AbInventechController::class);
    Route::resource('gdprs', GdprController::class);
    Route::resource('certificates', CertificateController::class);
//Route::resource('emails', EmailController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('evaluations', EvaluationController::class);
    Route::resource('follow_up_tests', FollowUpTestController::class);
    Route::get('trainings/upcoming', [TrainingController::class, 'upcoming'])->name('trainings.upcoming');
    Route::get('trainings/past', [TrainingController::class, 'past'])->name('trainings.past');
    Route::resource('trainings', TrainingController::class);
    Route::resource('follow_up_materials', FollowUpMaterialController::class);
    Route::resource('preparations', PreparationController::class);
    Route::resource('requirements', RequirementController::class);
    Route::get('/profiles', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles', [ProfileController::class, 'update'])->name('profiles.update');
});
