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
        return view('crud.ab_inventech.index', compact('abInventechs'));
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
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
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
        return view('crud.ab_inventech.show', compact('abInventech'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function edit(AbInventech $abInventech)
    {
        return view('crud.ab_inventech.edit', compact('abInventech'));
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
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // update postal code
        $abInventech->address->postalCode->update([
            'postal_code' => $request->postal_code,
            'city'        => $request->city,
            'country'     => $request->country,
        ]);

        // update address
        $abInventech->address->update([
            'street_name'   => $request->street_name,
            'street_number' => $request->street_number,
        ]);

        if ($request->hasFile('logo')) {

           if ($abInventech->logo) {
                Storage::delete('public/' . $abInventech->logo);
            }
            $validated['logo'] = $request->file('logo')->store('ab_inventech', 'public');
        }

//        updated ab inventech
        $abInventech->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('ab_inventech.index')->with('success', 'AB Inventech information updated successfully.');
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
