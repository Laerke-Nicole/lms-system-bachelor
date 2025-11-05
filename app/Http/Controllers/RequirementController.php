<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirements = Requirement::latest()->paginate(5);
        return view('requirements.index', compact('requirements'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requirements.create');
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
            'content' => 'required',
        ]);

        // create a new requirement in the db
        Requirement:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('requirements.index')->with('success', 'Requirement created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        return view('requirements.show', compact('requirement'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        return view('requirements.edit', compact('requirement'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirement $requirement)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // update a new requirement in the db
        $requirement->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('requirements.index')->with('success', 'Requirement updated successfully.');
    }


    /**
     * Remove the requirement based on the id from the db.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        // delete the requirement from the db
        $requirement->delete();

        //  redirect the user and send a success message
        return redirect()->route('requirements.index')->with('success', 'Requirement deleted successfully.');
    }
}
