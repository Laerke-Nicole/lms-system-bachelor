<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    //    register view
    public function showRegister() {
        $sites = Site::all();
        return view('auth.register', compact('sites'));
    }

    //    handle register form
    public function Register(Request $request) {
        //        validate user inputs
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'site_id' => 'required|exists:sites,id',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //        create user and store it
        $user = User::create($validated);

        //        start session and save in cookie
        Auth::login($user);

        return redirect()->route('home');
    }
}
