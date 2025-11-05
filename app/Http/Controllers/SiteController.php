<?php

namespace App\Http\Controllers;

use App\Models\Site;
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
        return view('sites.index', compact('sites'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sites.create');
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
            'site_name' => 'required',
            'site_mail' => 'required|email',
            'site_phone' => 'required',
        ]);

        // create a new site in the db
        Site:: create($request->all());

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
        return view('sites.show', compact('site'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
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
        $request->validate([
            'site_name' => 'required',
            'site_mail' => 'required|email',
            'site_phone' => 'required',
        ]);

        // update a new site in the db
        $site->update($request->all());

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
