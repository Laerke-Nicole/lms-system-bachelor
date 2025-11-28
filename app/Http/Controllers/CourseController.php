<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'duration_months' => 'required|integer',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('courses', 'public');
            $validated['image'] = $imagePath;
        }

        // create a new courses in the db
        Course::create($validated);

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
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'duration_months' => 'required|integer',
            'max_participants' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::delete('public/' . $course->image);
            }
            $imagePath = $request->file('image')->store('courses', 'public');
            $validated['image'] = $imagePath;
        }

        // update a new courses in the db
        $course->update($validated);

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }


    /**
     * Remove the courses based on the id from the db.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if ($course->image) {
            Storage::delete('public/' . $course->image);
        }

        // delete the courses from the db
        $course->delete();

        //  redirect the user and send a success message
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
