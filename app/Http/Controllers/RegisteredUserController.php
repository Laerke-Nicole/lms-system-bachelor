<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    //    register view
    public function showRegister() {
        $companies = Company::all();
        return view('auth.register', compact('companies'));
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
}
