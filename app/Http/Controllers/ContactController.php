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
        $ab_inventech = AbInventech::first()->load('address.postalCode');

        return view('auth.profiles.contacts', compact('ab_inventech'));
    }
}
