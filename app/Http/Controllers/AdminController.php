<?php

namespace App\Http\Controllers;

use App\Mail\UserCredentials;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of admin users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->orderBy('first_name')
            ->paginate(10);

        return view('crud.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.admins.create');
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:254|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Generate random password if not provided
        if (empty($validated['password'])) {
            $password = Str::random(8);
            $validated['password'] = $password;
        } else {
            $password = $validated['password'];
        }

        // Set role to admin and site_id to null (admins don't belong to a site)
        $validated['role'] = 'admin';
        $validated['site_id'] = null;

        $admin = User::create($validated);

        // Send email with credentials
        try {
            Mail::to($admin->email)->send(new UserCredentials(
                $admin->first_name,
                $admin->last_name,
                $admin->email,
                $password,
                route('login'),
                $admin->role
            ));
        } catch (\Throwable $e) {
            \Log::error('Failed to send admin credentials email: ' . $e->getMessage());
        }

        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    /**
     * Display the specified admin.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        return view('crud.admins.show', compact('admin'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        // Prevent deleting yourself
        if ($admin->id === auth()->id()) {
            return redirect()->route('admins.index')->with('error', 'You cannot delete your own account.');
        }

        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }
}
