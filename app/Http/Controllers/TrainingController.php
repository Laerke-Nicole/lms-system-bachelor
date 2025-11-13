<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
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
        $validated = $request->validate([
            'place' => 'required',
            'status' => 'required|in:Upcoming,Completed,Expired',
            'training_date' => 'required|date',

            'reminder_before_training' => [
                Rule::requiredIf($request->status === 'Upcoming'),
                'date',
            ],

            'reminder_sent_18_m' => [
                Rule::requiredIf(in_array($request->status === 'Completed','Expired'))
            ],

            'reminder_sent_22_m' => [
                Rule::requiredIf(in_array($request->status === 'Completed','Expired'))
            ],
        ]);

        // create a new training in the db
        Training:: create($validated);

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
        $places = ['Online', 'On site'];
        $statuses = ['Upcoming', 'Completed', 'Expired'];
        $trainers = User::all();
        $orderedBys = User::all();

        return view('trainings.edit', compact('training', 'places', 'statuses', 'trainers', 'orderedBys'));
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
        $validated = $request->validate([
            'place' => 'required',
            'status' => 'required',
            'training_date' => 'required|date',
        ]);

        // update a new training in the db
        $training->update($validated);

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
