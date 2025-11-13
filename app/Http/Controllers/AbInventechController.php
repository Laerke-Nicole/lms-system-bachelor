<?php

namespace App\Http\Controllers;

use App\Models\AbInventech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbInventechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abInventechs = AbInventech::latest()->paginate(5);
        return view('ab_inventech.index', compact('abInventechs'))->with(request()->input('page'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the user input
        $validated = $request->validate([
            'ab_inventech_name' => 'required',
            'ab_inventech_mail' => 'required|email',
            'ab_inventech_phone' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('ab_inventech', 'public');
            $validated['logo'] = $logoPath;
        }

        // create a new ab inventech in the db
        AbInventech::create($validated);

        //  redirect the user and send a success message
        return redirect()->route('ab_inventech.index')->with('success', 'AB Inventech created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function show(AbInventech $abInventech)
    {
        return view('ab_inventech.show', compact('abInventech'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function edit(AbInventech $abInventech)
    {
        return view('ab_inventech.edit', compact('abInventech'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbInventech $abInventech)
    {
        // validate the user input
        $validated = $request->validate([
            'ab_inventech_name' => 'required',
            'ab_inventech_mail' => 'required|email',
            'ab_inventech_phone' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($abInventech->logo) {
                Storage::delete('public/' . $abInventech->logo);
            }
            $logoPath = $request->file('logo')->store('ab_inventech', 'public');
            $validated['logo'] = $logoPath;
        }

        // update a new ab inventech in the db
        $abInventech->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('ab_inventech.index')->with('success', 'AB Inventech updated successfully.');
    }


    /**
     * Remove the ab inventech based on the id from the db.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbInventech $abInventech)
    {
        if ($abInventech->logo) {
            Storage::delete('public/' . $abInventech->logo);
        }

        // delete the ab inventech from the db
        $abInventech->delete();

        //  redirect the user and send a success message
        return redirect()->route('ab_inventech.index')->with('success', 'AB Inventech deleted successfully.');
    }
}
