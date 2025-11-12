<?php

namespace App\Http\Controllers;

use App\Models\AbInventech;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbInventech  $ab_inventech
     * @return \Illuminate\Http\Response
     */
    public function show(AbInventech $ab_inventech)
    {
        $info = AbInventech::first();

        return view('auth.profiles.contacts', compact('info'));
    }
}
