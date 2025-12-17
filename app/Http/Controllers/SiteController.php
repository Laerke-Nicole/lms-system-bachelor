<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use App\Models\Address;
use App\Models\Site;
use App\Models\Company;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::latest()->paginate(5);
        return view('crud.sites.index', compact('sites'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('crud.sites.create', compact('companies'));
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
            'site_name' => 'required',
            'site_mail' => 'required|email',
            'site_phone' => 'required',
            'company_id' => 'required|exists:companies,id',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
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

        // create site including address id
        Site::create($validated);

        //  redirect the user and send a success message
        return redirect()->route('sites.index')->with('success', 'Site created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        return view('crud.sites.show', compact('site'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        $companies = Company::all();

        return view('crud.sites.edit', compact('site'), compact('companies'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        // validate the user input
        $validated = $request->validate([
            'site_name' => 'required',
            'site_mail' => 'required|email',
            'site_phone' => 'required',
            'street_name' => 'required|string|max:255',
            'street_number' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        // update postal code
        $site->address->postalCode->update([
            'postal_code' => $request->postal_code,
            'city'        => $request->city,
            'country'     => $request->country,
        ]);

        // update address
        $site->address->update([
            'street_name'   => $request->street_name,
            'street_number' => $request->street_number,
        ]);

//        update site
        $site->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }


    /**
     * Remove the site based on the id from the db.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        // delete the site from the db
        $site->delete();

        //  redirect the user and send a success message
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }
}
