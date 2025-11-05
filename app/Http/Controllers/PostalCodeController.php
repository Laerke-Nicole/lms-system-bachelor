<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postalCodes = PostalCode::latest()->paginate(5);
        return view('postal_codes.index', compact('postalCodes'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postal_codes.create');
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
        $request->validate([
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        // create a new postal code in the db
        PostalCode:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('postal_codes.index')->with('success', 'Postal code created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostalCode  $postalCode
     * @return \Illuminate\Http\Response
     */
    public function show(PostalCode $postalCode)
    {
        return view('postal_codes.show', compact('postalCode'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostalCode  $postalCode
     * @return \Illuminate\Http\Response
     */
    public function edit(PostalCode $postalCode)
    {
        return view('postal_codes.edit', compact('postalCode'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostalCode  $postalCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostalCode $postalCode)
    {
        // validate the user input
        $request->validate([
            'postal_code' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        // update a new postal code in the db
        $postalCode->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('postal_codes.index')->with('success', 'Postal code updated successfully.');
    }


    /**
     * Remove the postal code based on the id from the db.
     *
     * @param  \App\Models\PostalCode  $postalCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostalCode $postalCode)
    {
        // delete the postal code from the db
        $postalCode->delete();

        //  redirect the user and send a success message
        return redirect()->route('postal_codes.index')->with('success', 'Postal code deleted successfully.');
    }
}
