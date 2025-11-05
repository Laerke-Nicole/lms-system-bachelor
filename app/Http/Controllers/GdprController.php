<?php

namespace App\Http\Controllers;

use App\Models\Gdpr;
use Illuminate\Http\Request;

class GdprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gdprs = Gdpr::latest()->paginate(5);
        return view('gdprs.index', compact('gdprs'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gdprs.create');
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
            'valid_until' => 'required|date',
            'consent_date' => 'required|date',
        ]);

        // create a new gdpr in the db
        Gdpr:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('gdprs.index')->with('success', 'GDPR created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gdpr  $gdpr
     * @return \Illuminate\Http\Response
     */
    public function show(Gdpr $gdpr)
    {
        return view('gdprs.show', compact('gdpr'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gdpr  $gdpr
     * @return \Illuminate\Http\Response
     */
    public function edit(Gdpr $gdpr)
    {
        return view('gdprs.edit', compact('gdpr'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gdpr  $gdpr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gdpr $gdpr)
    {
        // validate the user input
        $request->validate([
            'valid_until' => 'required|date',
            'consent_date' => 'required|date',
        ]);

        // update a new gdpr in the db
        $gdpr->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('gdprs.index')->with('success', 'GDPR updated successfully.');
    }


    /**
     * Remove the gdpr based on the id from the db.
     *
     * @param  \App\Models\Gdpr  $gdpr
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gdpr $gdpr)
    {
        // delete the gdpr from the db
        $gdpr->delete();

        //  redirect the user and send a success message
        return redirect()->route('gdprs.index')->with('success', 'GDPR deleted successfully.');
    }
}
