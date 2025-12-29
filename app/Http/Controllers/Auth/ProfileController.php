<?php

namespace App\Http\Controllers\Auth;

use App\Models\Certificate;
use App\Models\Site;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        $companies = Site::all();
        return view('auth.profiles.edit', compact('user', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // validate the user input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255',
            'leader_can_view_info' => 'nullable|boolean',
        ]);

        // update user info in the db
        $user->update($request->only(['first_name', 'last_name', 'email', 'phone', 'leader_can_view_info']));

        //  redirect the user and send a success message
        return redirect()->route('profiles.edit')->with('success', 'Updated your info successfully.');
    }

    public function certificates()
    {
//        admins can enter this page
        abort_if(auth()->user()->role === 'admin', 403);

        $user = Auth::user();

//        get the certificates belonging to the user
        $certificates = Certificate::whereHas('trainingUser', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('auth.profiles.certificates', compact('user', 'certificates'));
    }

    public function editPassword()
    {
        return view('auth.profiles.password-edit');
    }
}
