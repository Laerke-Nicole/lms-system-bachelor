<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::latest()->paginate(5);
        return view('addresses.index', compact('addresses'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addresses.create');
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
            'street_name' => 'required',
            'street_number' => 'required',
        ]);

        // create a new address in the db
        Address:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        // validate the user input
        $request->validate([
            'street_name' => 'required',
            'street_number' => 'required',
        ]);

        // update a new address in the db
        $address->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }


    /**
     * Remove the address based on the id from the db.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        // delete the address from the db
        $address->delete();

        //  redirect the user and send a success message
        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }
}
