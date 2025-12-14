<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.index', compact('users'))->with(request()->input('page'));
    }

//    public function showRegister() {
//        $sites = Site::all();
//        return view('auth.register', compact('sites'));
//    }
//
//    public function Register(Request $request) {
//        //        validate user inputs
//        $validated = $request->validate([
//            'first_name' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
//            'phone' => 'required|string|max:255',
//            'email' => 'required|email|unique:users',
//            'site_id' => 'required|exists:sites,id',
//            'password' => 'required|string|min:8|confirmed',
//        ]);
//
//        //        create user and store it
//        User::create($validated);
//
//        //  redirect the user and send a success message
//        return redirect()->route('users.index')->with('success', 'User account created successfully.');
//    }

    /**
     * Remove the user based on the id from the db.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // delete the user from the db
        $user->delete();

        //  redirect the user and send a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
