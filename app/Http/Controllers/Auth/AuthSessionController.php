<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AbInventech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthSessionController extends Controller
{
    //    login view
    public function showLogin() {

        $abInventech = AbInventech::first();

        return view('auth.login', compact('abInventech'));
    }

    //    handle login form
    public function Login(Request $request) {
        //        validate user inputs
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //      attempt to log user in with the input data they sent
        if (Auth::attempt($validated)) {
            //          prevent hacker from using a session to gain access to another users account
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'credentials' => 'The provided credentials are incorrect.',
        ]);
    }


    public function logout(Request $request) {
        Auth::logout();

        //        remove all data that was in the session
        $request->session()->invalidate();

        //      regenerate csrf token in the next session so user cant submit a form with its previous token
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
