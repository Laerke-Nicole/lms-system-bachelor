<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
//    register view
    public function showRegister() {
        $companies = Company::all();
        return view('auth.register', compact('companies'));
    }

//    login view
    public function showLogin() {
        return view('auth.login');
    }

//    handle register form
    public function Register(Request $request) {
//        validate user inputs
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'company_id' => 'required|exists:companies,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

//        hasing password
        $validated['password'] = Hash::make($validated['password']);

//        create user and store it
        $user = User::create($validated);

//        start session and save in cookie
        Auth::login($user);

        return redirect()->route('home');

    }

//    handle login form
    public function Login(Request $request) {
//        validate user inputs
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

//        attempt to log user in with the input data they sent
        if (Auth::attempt($validated)) {
//            prevent hacker from using a session to gain access to another users account
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

//        regenerate csrf token in the next session so user cant submit a form with its previous token
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
