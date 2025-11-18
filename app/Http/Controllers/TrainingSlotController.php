<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\TrainingSlot;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\User;

class TrainingSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $trainingSlots = TrainingSlot::orderBy('training_date', 'asc')->paginate(5);
        return view('training_slots.index', compact('trainingSlots'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $places = ['Online', 'On site'];
        $statuses = ['Available', 'Unavailable'];
        $trainers = User::where('role', 'admin')->get();

        return view('training_slots.create', compact('courses', 'places', 'statuses', 'trainers'));
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
            'course_id' => 'required|exists:courses,id',
            'trainer_id' => 'required|exists:users,id',
            'place' => 'required',
            'training_date' => 'required|date',
            'participation_link' => ['nullable', 'url'],
        ]);

        // add the admin who created this slot
        $validated['created_by_admin_id'] = auth()->id();

        // create a new training slot in the db
        TrainingSlot::create($validated);

        //  redirect the user and send a success message
        return redirect()->route('training_slots.index')->with('success', 'Training slot created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingSlot  $trainingSlot
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingSlot $trainingSlot)
    {
        return view('training_slots.show', compact('trainingSlot'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingSlot  $trainingSlot
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainingSlot $trainingSlot)
    {
        $courses = Course::all();
        $places = ['Online', 'On site'];
        $statuses = ['Available', 'Unavailable'];
        $trainers = User::where('role', 'admin')->get();

        return view('training_slots.edit', compact('trainingSlot', 'courses', 'places', 'statuses', 'trainers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TrainingSlot  $trainingSlot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrainingSlot $trainingSlot)
    {
        // validate the user input
        $validated = $request->validate([
            'trainer_id' => 'required|exists:users,id',
            'place' => 'required',
            'training_date' => 'required|date',
            'participation_link' => ['nullable', 'url'],
        ]);

        // update the training slot in the db
        $trainingSlot->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('training_slots.index')->with('success', 'Training slot updated successfully.');
    }

    /**
     * Remove the training slot based on the id from the db.
     *
     * @param  \App\Models\TrainingSlot  $trainingSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingSlot $trainingSlot)
    {
        // delete the training slot from the db
        $trainingSlot->delete();

        //  redirect the user and send a success message
        return redirect()->route('training_slots.index')->with('success', 'Training slot deleted successfully.');
    }
}
