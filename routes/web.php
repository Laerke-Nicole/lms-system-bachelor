<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

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
    Route::get('/profiles/certificates', [ProfileController::class, 'certificates'])->name('profiles.certificates');
    Route::get('/profiles/contacts', [ContactController::class, 'show'])->name('profiles.contacts');
});


//    request password reset link
//    user sends their email and request for an email reset link
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

//    handle submit to reset password
Route::post('/forgot-password', function (Request $request) {
//    validate email
    $request->validate(['email' => 'required|email']);

//    send reset link to user
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

//    reset password
//    form for when user clicks email with the link to reset pass
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

//    handle resetting the password
Route::post('/reset-password', function (Request $request) {
    //        validate the inputs and token
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    //        validate pass reset
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
