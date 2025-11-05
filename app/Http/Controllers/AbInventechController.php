<?php

namespace App\Http\Controllers;

use App\Models\AbInventech;
use Illuminate\Http\Request;

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
        return view('ab_inventechs.index', compact('abInventechs'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ab_inventechs.create');
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
            'ab_inventech_name' => 'required',
            'ab_inventech_mail' => 'required|email',
            'ab_inventech_phone' => 'required',
        ]);

        // create a new ab inventech in the db
        AbInventech:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('ab_inventechs.index')->with('success', 'AB Inventech created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function show(AbInventech $abInventech)
    {
        return view('ab_inventechs.show', compact('abInventech'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function edit(AbInventech $abInventech)
    {
        return view('ab_inventechs.edit', compact('abInventech'));
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
        $request->validate([
            'ab_inventech_name' => 'required',
            'ab_inventech_mail' => 'required|email',
            'ab_inventech_phone' => 'required',
        ]);

        // update a new ab inventech in the db
        $abInventech->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('ab_inventechs.index')->with('success', 'AB Inventech updated successfully.');
    }


    /**
     * Remove the ab inventech based on the id from the db.
     *
     * @param  \App\Models\AbInventech  $abInventech
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbInventech $abInventech)
    {
        // delete the ab inventech from the db
        $abInventech->delete();

        //  redirect the user and send a success message
        return redirect()->route('ab_inventechs.index')->with('success', 'AB Inventech deleted successfully.');
    }
}
