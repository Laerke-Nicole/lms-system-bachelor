<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;


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
        ? redirect()->route('password.reset.sent')
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

Route::get('/password-reset-sent', function () {
    return view('auth.password-reset-sent');
})->middleware('guest')->name('password.reset.sent');
