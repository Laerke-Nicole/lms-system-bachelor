<?php

namespace App\Http\Controllers;

use App\Models\Preparation;
use Illuminate\Http\Request;

class PreparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preparations = Preparation::latest()->paginate(5);
        return view('preparations.index', compact('preparations'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('preparations.create');
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
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // create a new preparation in the db
        Preparation:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('preparations.index')->with('success', 'Preparation created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function show(Preparation $preparation)
    {
        return view('preparations.show', compact('preparation'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function edit(Preparation $preparation)
    {
        return view('preparations.edit', compact('preparation'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preparation $preparation)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // update a new preparation in the db
        $preparation->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('preparations.index')->with('success', 'Preparation updated successfully.');
    }


    /**
     * Remove the preparation based on the id from the db.
     *
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preparation $preparation)
    {
        // delete the preparation from the db
        $preparation->delete();

        //  redirect the user and send a success message
        return redirect()->route('preparations.index')->with('success', 'Preparation deleted successfully.');
    }
}
