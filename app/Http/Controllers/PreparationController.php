<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Preparation;
use Illuminate\Http\Request;

class PreparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $preparations = $course->preparations()->latest()->paginate(5);

        return view('courses.preparations.index', compact('course', 'preparations'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        $types = ['Video', 'PDF', 'Task', 'Quiz', 'Other'];

        return view('courses.preparations.create', compact('course', 'types'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // create a new preparation in the db
        $course->preparations()->create($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.preparations.index', $course)->with('success', 'Preparation created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Preparation $preparation)
    {
        $types = ['Video', 'PDF', 'Task', 'Quiz', 'Other'];

        return view('courses.preparations.edit', compact('course', 'preparation', 'types'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, Preparation $preparation)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'url' => 'required|url',
        ]);

        // update a new preparation in the db
        $preparation->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.preparations.index', $course)->with('success', 'Preparation updated successfully.');
    }


    /**
     * Remove the preparation based on the id from the db.
     *
     * @param  \App\Models\Preparation  $preparation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Preparation $preparation)
    {
        // delete the preparation from the db
        $preparation->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.preparations.index', $course)->with('success', 'Preparation deleted successfully.');
    }
}
