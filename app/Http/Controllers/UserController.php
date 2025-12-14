<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $users = User::query()->latest()
//            dont show admins
            ->where('role', '!=', 'admin')
//            when the user is leader show only the users based on their site otherwise show all users
            ->when($user->role === 'leader', function ($q) use ($user) {
                $q->where('site_id', $user->site_id);
            })
            ->paginate(8)
            ->withQueryString();

        return view('users.index', compact('users'))->with(request()->input('page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

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

//        get the logged in user (admin or leader)
        $authUser = auth()->user();

        //        redirect view message depending on the users role
        if ($authUser->role === 'admin') {
            return redirect()->route('users.index')->with('success', 'Leader deleted successfully.');
        }

        if ($authUser->role === 'leader') {
            return redirect()->route('users.index')->with('success', 'Employee deleted successfully.');
        }
    }
}
