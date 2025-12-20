<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Course $course)
    {
        $requirements = $course->requirements()->latest()->paginate(5);

        return view('crud.courses.requirements.index', compact('course', 'requirements'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('crud.courses.requirements.create', compact('course'));
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
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // create a new requirement in the db
        $course->requirements()->create($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.requirements.index', $course)->with('success', 'Requirement created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course, Requirement $requirement)
    {
        return view('crud.courses.requirements.show', compact('course', 'requirement'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course, Requirement $requirement)
    {
        return view('crud.courses.requirements.edit', compact('course', 'requirement'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course, Requirement $requirement)
    {
        // validate the user input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // update a new requirement in the db
        $requirement->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.requirements.index', $course)->with('success', 'Requirement updated successfully.');
    }


    /**
     * Remove the requirement based on the id from the db.
     *
     * @param  \App\Models\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course, Requirement $requirement)
    {
        // delete the requirement from the db
        $requirement->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.requirements.index', $course)->with('success', 'Requirement deleted successfully.');
    }
}
