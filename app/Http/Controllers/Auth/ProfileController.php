<?php

namespace App\Http\Controllers\Auth;

use App\Models\Company;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        // Eager load related trainings (certificates)
        $user->load('trainings');

        $companies = Company::all();
        return view('auth.profiles.edit', compact('user', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // validate the user input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
        ]);

        // update user info in the db
        $user->update($request->only(['first_name', 'last_name', 'email', 'phone']));

        //  redirect the user and send a success message
        return redirect()->route('profiles.edit')->with('success', 'Updated your info successfully.');
    }

    public function certificates()
    {
        $user = Auth::user();

        $user->load('trainings');
    }
}
