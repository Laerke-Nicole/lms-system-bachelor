<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = Training::latest()->paginate(5);
        return view('trainings.index', compact('trainings'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainings.create');
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
            'place' => 'required',
            'status' => 'required',
            'training_time' => 'required',
            'training_date' => 'required|date',
        ]);

        // create a new training in the db
        Training:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        return view('trainings.show', compact('training'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        return view('trainings.edit', compact('training'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        // validate the user input
        $request->validate([
            'place' => 'required',
            'status' => 'required',
            'training_time' => 'required',
            'training_date' => 'required|date',
        ]);

        // update a new training in the db
        $training->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }


    /**
     * Remove the training based on the id from the db.
     *
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        // delete the training from the db
        $training->delete();

        //  redirect the user and send a success message
        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}
