<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('courses.index', compact('courses'))->with(request()->input('page'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
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
            'description' => 'required',
            'duration_months' => 'required|integer',
        ]);

        // create a new course in the db
        Course:: create($request->all());

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        // validate the user input
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration_months' => 'required|integer',
        ]);

        // update a new course in the db
        $course->update($request->all());

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }


    /**
     * Remove the course based on the id from the db.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        // delete the course from the db
        $course->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
