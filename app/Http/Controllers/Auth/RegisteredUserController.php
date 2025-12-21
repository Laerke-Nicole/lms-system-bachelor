<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserCredentials;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    //    register view
    public function showRegister() {
        $user = auth()->user();

//        if user isnt leader or admin send 403
        abort_unless(in_array($user->role, ['admin', 'leader']), 403);

        $sites = Site::with('company')->get();
        return view('auth.register', compact('sites'));
    }

    //    handle register form
    public function Register(Request $request) {
        $user = auth()->user();

//        if user isnt leader or admin send 403
        abort_unless(in_array($user->role, ['admin', 'leader']), 403);

        //        validate user inputs
        $userInfo = [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:254|unique:users',
            'password' => 'nullable|string|min:8|confirmed',
        ];

//        if user is admin be able to choose the site themselves and make the user a leader
        if ($user->role === 'admin') {
            $userInfo['site_id'] = 'required|exists:sites,id';
        }

        $validated = $request->validate($userInfo);

//        make the user role leader when an admin creates a user
        if ($user->role === 'admin') {
            $validated['role'] = 'leader';
        }

//        if user is leader submit the site_id as the users site_id
        if ($user->role === 'leader') {
            $validated['site_id'] = $user->site_id;
        }

//        if password input field is empty then make a random password
        if (!$validated['password']) {
            $password = Str::random(8);
            $validated['password'] = $password;
        } else {
            $password = $validated['password'];
        }

        //        create user
        $newUser = User::create($validated);

//        send email to the user with the email in the input when their account is created
        Mail::to($newUser->email)->send(new UserCredentials(
            $newUser->first_name,
            $newUser->last_name,
            $newUser->email,
            $password,
            route('login'),
            $newUser->role
        ));

//        return view message depending on the users role
        if ($user->role === 'admin') {
            return redirect()->route('users.index')->with('success', 'Leader created successfully.');
        }

        if ($user->role === 'leader') {
            return redirect()->route('users.index')->with('success', 'Employee created successfully.');
        }
    }
}
