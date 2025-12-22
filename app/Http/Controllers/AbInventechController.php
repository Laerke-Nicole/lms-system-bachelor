<?php

namespace App\Http\Controllers;

use App\Models\AbInventech;
use App\Models\Address;
use App\Models\PostalCode;
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
            'ab_inventech_name' => 'required|string|max:255',
            'ab_inventech_web' => 'required|url|max:512',
            'ab_inventech_mail' => 'required|email|max:254',
            'ab_inventech_phone' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:20',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // create postal code
        $postalCode = PostalCode::create([
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        // create address including postal code id
        $address = Address::create([
            'street_name' => $request->street_name,
            'street_number' => $request->street_number,
            'postal_code_id' => $postalCode->id,
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('ab_inventech', 'public');
        }

        // create ab inventech including address id
        AbInventech::create([
            'ab_inventech_name' => $request->ab_inventech_name,
            'ab_inventech_web' => $request->ab_inventech_web,
            'ab_inventech_mail' => $request->ab_inventech_mail,
            'ab_inventech_phone' => $request->ab_inventech_phone,
            'logo' => $logoPath,
            'address_id' => $address->id,
        ]);

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
            'ab_inventech_name' => 'required|string|max:255',
            'ab_inventech_web' => 'required|url|max:512',
            'ab_inventech_mail' => 'required|email|max:254',
            'ab_inventech_phone' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:20',
            'postal_code' => 'required|string|max:20',
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
                Storage::disk('public')->delete($abInventech->logo);
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
            Storage::disk('public')->delete($abInventech->logo);
        }

        // delete the ab inventech from the db
        $abInventech->delete();

        //  redirect the user and send a success message
        return redirect()->route('ab_inventech.index')->with('success', 'AB Inventech deleted successfully.');
    }
}
